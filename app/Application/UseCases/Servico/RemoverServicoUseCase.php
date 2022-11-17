<?php

namespace App\Application\UseCases\Servico;

use App\Domain\Repositories\ServicoRepositoryInterface;

class RemoverServicoUseCase
{
    public function __construct(private readonly ServicoRepositoryInterface $servicoRepository){}

    public function handle(int $servicoId): ?bool
    {
        try {
            $this->servicoRepository->remover($servicoId);
            return true;
        } catch (\Exception  $exception) {
            return false;
        }
    }
}