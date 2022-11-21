<?php

namespace App\Infra\Adapters;

use App\Domain\DTOs\AgendamentoDTO;
use App\Domain\DTOs\ServicoAgendamentoDTO;
use App\Domain\DTOs\UsuarioDTO;
use App\Domain\Entities\Agendamento;
use App\Domain\Entities\Servico;
use App\Domain\Entities\ServicoAgendamento;
use App\Domain\Entities\Servicos;
use App\Domain\Entities\ServicosAgendamento;
use App\Domain\Entities\Usuario;
use App\Domain\Exceptions\DataBaseException;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Endereco;
use App\Domain\ValueObjects\Telefone;
use PDO;

class AgendamentoPostgresPDOAdapter implements AgendamentoPDOAdapter
{

    public function __construct(private readonly PDO $PDO)
    {
    }

    /**
     * @throws DataBaseException
     */
    public function agendarServico(AgendamentoDTO $agendamentoDTO): Agendamento
    {
        $sqlInsertAgendamento = "insert into agendamento (cliente_id, funcionario_id, valor_total, horario, data,
                         created_at, updated_at)
            values (?, ?, ?, ?, ? , ?, ?)
            returning *";

        $this->PDO->beginTransaction();

        $statementAgendamento = $this->PDO->prepare($sqlInsertAgendamento);

        $valorTotal = $agendamentoDTO->getValorTotal();
        $dataAtual = date('Y-m-d H:i:s');


        try {

            $agendamentoRealizado = $statementAgendamento->execute([
                $agendamentoDTO->cliente->id,
                $agendamentoDTO->funcionario->id,
                $valorTotal,
                $agendamentoDTO->horario->format("H:i:s"),
                $agendamentoDTO->data->format("Y-m-d"),
                $dataAtual,
                $dataAtual
            ]);

            if (!$agendamentoRealizado) {
                throw new DataBaseException("Não foi possível agendar");
            }

            $agendamentoDados = $statementAgendamento->fetch(PDO::FETCH_ASSOC);

            $servicos = $this->agendarServicoPorAgendamento($agendamentoDTO->servicos, $agendamentoDados["id"]);


            $this->PDO->commit();
            return new Agendamento(
                cliente: $this->getUsuarioById($agendamentoDados["cliente_id"]),
                funcionario: $this->getUsuarioById($agendamentoDados["funcionario_id"]),
                valorTotal: $valorTotal,
                horario: $agendamentoDTO->horario,
                data: $agendamentoDTO->data,
                status: $agendamentoDados["status"],
                servicos: $servicos,
                id: $agendamentoDados["id"]
            );

        } catch (\Exception $exception) {
            $this->PDO->rollBack();
            throw new DataBaseException("Não foi possível agendar");
        }
    }

    /**
     * @param int $usuarioId
     * @return Usuario
     * @throws DataBaseException
     */
    private function getUsuarioById(int $usuarioId): Usuario
    {

        $usuarioStatement = $this->PDO->prepare("select * from usuario where id = :id");

        try {
            $usuarioStatement->execute([$usuarioId]);

            $usuario = $usuarioStatement->fetch();

            return (new Usuario(
                $usuario["nome"],
                new Telefone($usuario["telefone"]),
                $usuario["perfil_id"],
                new Email($usuario["email"]),
                new Endereco(
                    $usuario["logradouro"],
                    $usuario["numero"],
                    $usuario["cep"],
                    $usuario["bairro"],
                ),
                $usuario["id"]
            ));
        } catch (\Exception $exception) {
            throw new DataBaseException("Não foi possível obter o usuário");
        }
    }

    /**
     * @param Servicos $servicos
     * @param int $agendamentoId
     * @return Servicos
     * @throws DataBaseException
     */
    private function agendarServicoPorAgendamento(Servicos $servicos, int $agendamentoId): Servicos
    {

        $values = [];
        $valoresModelo = [];
        $dataAtual = date('Y-m-d');

        array_map(function (Servico $servico) use (&$values, &$valoresModelo, $dataAtual, $agendamentoId) {
            $valoresModelo[] = "(?,?,?,?)";
            $values = [$agendamentoId, $servico->id, $dataAtual, $dataAtual, ...$values];
        }, $servicos->getItens());

        $sql = sprintf("insert into agendamento_servico (agendamento_id,servico_id, created_at, updated_at) values %s returning *;",
            implode(',', $valoresModelo)
        );

        $statementServicoAgendamento = $this->PDO->prepare($sql);

        try {
            $statementServicoAgendamento->execute($values);

            $dados = $statementServicoAgendamento->fetchAll(PDO::FETCH_ASSOC);

            $servicosInstance = new Servicos();

            foreach ($dados as $item) {
                $servicosInstance->adicionar($this->getServicoById($item["servico_id"]));
            }
            return $servicosInstance;

        }catch (\Exception $exception){
            throw new DataBaseException("Não foi possível realizar o agendamento.");
        }

    }

    /**
     * @param int $servicoId
     * @return Servico
     * @throws DataBaseException
     */
    private function getServicoById(int $servicoId): Servico
    {

        $servicoStatement = $this->PDO->prepare("select * from servico where id = :id");

        try {
            $servicoStatement->execute([$servicoId]);

            $servico = $servicoStatement->fetch(PDO::FETCH_ASSOC);

            return (new Servico(
                $servico["nome"],
                (int) $servico["duracao"],
                (float) $servico["valor"],
                (int) $servico["id"]
            ));

        } catch (\Exception $exception) {
            throw new DataBaseException("Não foi possível obter o servico");
        }
    }
}