<?php

namespace App\Infra\Repositories;

use App\Domain\DTOs\AgendamentoDTO;
use App\Domain\Entities\Agendamento;
use App\Domain\Repositories\AgendamentoRepositoryInterface;
use App\Infra\Adapters\AgendamentoPDOAdapter;

class AgendamentoRepository implements AgendamentoRepositoryInterface
{
    public function __construct(private readonly AgendamentoPDOAdapter $agendamentoPDOAdapter){}

    /**
     * @param AgendamentoDTO $agendamentoDTO
     * @return Agendamento
     */
    public function agendarServico(AgendamentoDTO $agendamentoDTO) : Agendamento
    {
        return $this->agendamentoPDOAdapter->agendarServico($agendamentoDTO);
    }
}