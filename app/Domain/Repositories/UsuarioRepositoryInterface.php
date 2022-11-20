<?php
declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\DTOs\UsuarioDTO;
use App\Domain\Entities\Usuario;

interface UsuarioRepositoryInterface
{
    public function adicionar(UsuarioDTO $usuarioDTO) : Usuario;
    public function remover(int $usuarioID): bool;
    public function editar(UsuarioDTO $usuarioDTO, int $usuarioID):void;
    public function getUsuarioById(int $usuarioID): Usuario;

}