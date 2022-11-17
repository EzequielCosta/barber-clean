<?php
declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\DTOs\ServicoDTO;
use App\Domain\Entities\Usuario;

interface UsuarioRepositoryInterface
{
    public function adicionar(ServicoDTO $usuarioDTO) : Usuario;
    public function remover(int $usuarioID): bool;
    public function editar(ServicoDTO $usuarioDTO, int $usuarioID):void;

}