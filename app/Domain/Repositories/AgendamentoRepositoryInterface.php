<?php

namespace App\Domain\Repositories;

use App\Domain\DTOs\AgendamentoDTO;
use App\Domain\Entities\Agendamento;

interface AgendamentoRepositoryInterface
{
    public function agendarServico(AgendamentoDTO $agendamentoDTO): Agendamento;

}