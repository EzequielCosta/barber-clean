<?php

namespace App\Infra\Adapters;

use App\Domain\DTOs\AgendamentoDTO;
use App\Domain\Entities\Agendamento;

interface AgendamentoPDOAdapter
{
    public function agendarServico(AgendamentoDTO $agendamentoDTO): Agendamento;
}