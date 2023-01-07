<?php

namespace App\Application\UseCases\Agendamento;

use App\Domain\DTOs\AgendamentoDTO;
use App\Domain\Repositories\AgendamentoRepositoryInterface;
use App\Infra\Repositories\AgendamentoRepository;

class AgendarServicoUseCase
{
    public function __construct(private readonly AgendamentoRepositoryInterface $agendamentoRepository)
    {
    }

    /**
     * @param AgendamentoDTO $agendamentoDTO
     * @return void
     */
    public function handle(AgendamentoDTO $agendamentoDTO): void
    {
        $this->agendamentoRepository->agendarServico($agendamentoDTO);
    }
}