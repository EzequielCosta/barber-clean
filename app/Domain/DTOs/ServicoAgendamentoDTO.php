<?php

namespace App\Domain\DTOs;

use App\Domain\Entities\Agendamento;
use App\Domain\Entities\Servico;

final class ServicoAgendamentoDTO
{
    public function __construct(
        public readonly ?int $id,
        public Agendamento $agendamento,
        public Servico $servico
    ){}
}