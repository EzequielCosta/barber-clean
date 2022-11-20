<?php

namespace App\Application\UseCases\Servico;

use App\Domain\Entities\Servico;
use App\Domain\Repositories\ServicoRepositoryInterface;

class BuscarServicoPeloIdUseCase
{
    public function __construct(private readonly ServicoRepositoryInterface $servicoRepository){}

    public function handle(int $servicoId) : Servico
    {
        return $this->servicoRepository->getServicoById($servicoId);
    }
}