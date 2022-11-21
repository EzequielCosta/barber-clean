<?php

namespace App\Infra\Repositories;

use App\Domain\DTOs\ServicoDTO;
use App\Domain\Entities\Servico;
use App\Domain\Repositories\ServicoRepositoryInterface;
use App\Infra\Adapters\ServicoPDOAdapter;

class ServicoRepository implements ServicoRepositoryInterface
{

    public function __construct(private readonly ServicoPDOAdapter $servicoPDOAdapter){}

    /**
     * @param ServicoDTO $servicoDTO
     * @return void
     */
    public function adicionar(ServicoDTO $servicoDTO): void
    {
        $this->servicoPDOAdapter->adicionar($servicoDTO);
    }

    /**
     * @param int $servicoId
     * @return void
     */
    public function remover(int $servicoId): void
    {
        $this->servicoPDOAdapter->remover($servicoId);
    }

    /**
     * @param ServicoDTO $servicoDTO
     * @param int $servicoId
     * @return ServicoDTO
     */
    public function editar(ServicoDTO $servicoDTO, int $servicoId): ServicoDTO
    {
        return $this->servicoPDOAdapter->editar($servicoDTO, $servicoId);
    }

    /**
     * @param int $servicoId
     * @return Servico
     */
    public function getServicoById(int $servicoId): Servico
    {
        return $this->servicoPDOAdapter->getServicoById($servicoId);
    }
}