<?php

namespace App\Infra\Adapters;

use App\Domain\DTOs\AgendamentoDTO;
use PDO;

class AgendamentoPostgresPDOAdapter implements AgendamentoPDOAdapter
{

    public function __construct(private readonly PDO $PDO){}

    public function agendarServico(AgendamentoDTO $agendamentoDTO): bool
    {
        $sqlInsertAgendamento = "insert into agendamento (cliente_id, funcionario_id, valor_total, horario, data,
                         created_at, updated_at)
            values (cliente_id = :cliente_id, funcionario_id = :funcionario_id, valor_total = :valor_total,
                    horario = :horario, data = :data , created_at = :created_at, updated_at = :updated_at)
            returning *";

        $statementAgendamento = $this->PDO->prepare($sqlInsertAgendamento);
        $statementAgendamento->execute([
            $agendamentoDTO->cliente->id,
            $agendamentoDTO->funcionario->id,
            $agendamentoDTO->servicosAgendamento->valorTotal(),
            $agendamentoDTO->horario,
            $agendamentoDTO->data,
            date('Y-m-d H:i:ss'),
            date('Y-m-d H:i:ss'),
        ]);

        //$statementAgendamento = $this->PDO->prepare();
    }
}