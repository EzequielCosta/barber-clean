<?php

namespace App\Infra\Adapters;

use App\Domain\DTOs\UsuarioDTO;
use App\Domain\Entities\Usuario;

interface UsuarioPDOAdapter
{
    public function adicionar(UsuarioDTO $user): Usuario;
    public function remover(int $usuarioId): bool;
    public function editar(UsuarioDTO $usuarioDTO, int $usuarioID): void;
    public function getUsuarioById(int $usuarioID): Usuario;
}