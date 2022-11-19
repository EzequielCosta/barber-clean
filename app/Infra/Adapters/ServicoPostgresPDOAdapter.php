<?php

namespace App\Infra\Adapters;

use App\Domain\DTOs\ServicoDTO;
use App\Domain\Exceptions\DataBaseException;
use App\Domain\Exceptions\InvalidValueException;
use PDO;

class ServicoPostgresPDOAdapter implements ServicoPDOAdapter
{

    public function __construct(private readonly PDO $PDO)
    {
    }

    /**
     * @param ServicoDTO $servicoDTO
     * @throws DataBaseException
     */
    public function adicionar(ServicoDTO $servicoDTO): void
    {
        $statementAdicionarUsuario = $this->PDO->prepare("insert into servico (nome, duracao, valor, created_at, updated_at )
            values (:nome, :duracao,:valor, :created_at, :updated_at)");

        $usuarioAdicionado = $statementAdicionarUsuario->execute(
            [
                $servicoDTO->nome,
                $servicoDTO->getDuracao(),
                $servicoDTO->getValor(),
                date('Y-m-d H:m:i'),
                date('Y-m-d H:m:i')
            ]
        );

        if (!$usuarioAdicionado) {
            throw new DataBaseException("Não foi possível adicionar o serviço");
        }
    }

    /**
     * @param int $servicoId
     * @return bool
     * @throws DataBaseException
     */
    public function remover(int $servicoId): void
    {
        $statementAdicionarUsuario = $this->PDO->prepare("delete from servico where id = :id");

        $usuarioRemovido = $statementAdicionarUsuario->execute([$servicoId]);

        if (!$usuarioRemovido) {
            throw new DataBaseException("Não foi possível adicionar o serviço");
        }
    }

    /**
     * @param ServicoDTO $servicoDTO
     * @param int $servicoId
     * @return ServicoDTO
     * @throws DataBaseException
     * @throws InvalidValueException
     */
    public function editar(ServicoDTO $servicoDTO, int $servicoId): ServicoDTO
    {

        $sqlUpdate = "update servico set ";

        $atributosBind = [];

        $dadosParaEdicao = $servicoDTO->attributesFilled();

        foreach ($dadosParaEdicao as $nomeDoCampo => $valorDoCampo) {
            $sqlUpdate .= " $nomeDoCampo = :$nomeDoCampo, ";
            $atributosBind[] = $valorDoCampo;
        }

        $virgulaFinal = str_ends_with($sqlUpdate, ',') ? ',' : '';

        $sqlUpdate .= "$virgulaFinal updated_at = :updated_at where id = :id returning *";

        $atributosBind[] = date('Y-m-d H:m:i');
        $atributosBind[] = $servicoId;

        $statementEditarServico = $this->PDO->prepare($sqlUpdate);

        $servicoEditado = $statementEditarServico->execute($atributosBind);

        if (!$servicoEditado) {
            throw new DataBaseException("Não foi possível adicionar o serviço");
        }

        $dadosDoServico = $statementEditarServico->fetch();

        return (new ServicoDTO(
            nome: $dadosDoServico["nome"],
            duracao: $dadosDoServico["duracao"],
            valor: $dadosDoServico["valor"]
        ));
    }

    public function getServicoById(int $servicoId)
    {

        $statement = $this->PDO->prepare("select * from servico where id = :id");

        $servico = $statement->fetch(PDO::FETCH_ASSOC);

    }
}