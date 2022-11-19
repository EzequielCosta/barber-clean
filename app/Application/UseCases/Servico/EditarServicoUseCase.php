<?php

namespace App\Application\UseCases\Servico;

use App\Application\Factories\ServicoFactory;
use App\Domain\DTOs\ServicoDTO;
use App\Domain\Entities\Servico;
use App\Domain\Repositories\ServicoRepositoryInterface;

class EditarServicoUseCase
{
    public function __construct(private readonly ServicoRepositoryInterface $servicoRepository, private readonly ServicoFactory $servicoFactory){}

    public function handle(ServicoDTO $servicoDTO, int $servicoId): ?Servico
    {
        try {
            $servicoDTOAtualizado = $this->servicoRepository->editar($servicoDTO, $servicoId);
            return $this->servicoFactory->fromDTO($servicoDTOAtualizado);
        } catch (\Exception  $exception) {
            echo $exception->getMessage();
            return null;
        }
    }
}