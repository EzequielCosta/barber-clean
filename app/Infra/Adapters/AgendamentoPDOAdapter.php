<?php

namespace App\Infra\Adapters;

use App\Domain\DTOs\AgendamentoDTO;

interface AgendamentoPDOAdapter
{
    public function agendarServico(AgendamentoDTO $agendamentoDTO): bool;
}