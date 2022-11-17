<?php

namespace App\Application\UseCases\Servico;

use App\Application\Factories\ServicoFactory;
use App\Domain\DTOs\ServicoDTO;
use App\Domain\Entities\Servico;
use App\Domain\Repositories\ServicoRepositoryInterface;

class AdicionarServicoUseCase
{

    public function __construct(private readonly ServicoRepositoryInterface $servicoRepository, private readonly ServicoFactory $servicoFactory){}

    public function handle(ServicoDTO $servicoDTO): ?Servico
    {
        try {
            $this->servicoRepository->adicionar($servicoDTO);
            return $this->servicoFactory->fromDTO($servicoDTO);
        } catch (\Exception  $exception) {
            return null;
        }
    }
}