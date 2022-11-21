<?php

namespace App\Domain\Repositories;

use App\Domain\DTOs\ServicoDTO;
use App\Domain\Entities\Servico;

interface ServicoRepositoryInterface
{
    public function adicionar(ServicoDTO $servicoDTO) : void;
    public function remover(int $servicoId) : void;
    public function editar(ServicoDTO $servicoDTO, int $servicoId) : ServicoDTO;
    public function getServicoById(int $servicoId) : Servico;
}