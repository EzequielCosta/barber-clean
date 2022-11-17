<?php

namespace App\Infra\Adapters;

use App\Domain\DTOs\ServicoDTO;

interface ServicoPDOAdapter
{
    public function adicionar(ServicoDTO $usuarioDTO): void;
    public function remover(int $servicoId) : void;
    public function editar(ServicoDTO $servicoDTO, int $servicoId) : void;
}