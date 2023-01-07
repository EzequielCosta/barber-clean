<?php

namespace App\Infra\Repositories;

use App\Domain\DTOs\UsuarioDTO;
use App\Domain\Entities\Usuario;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Infra\Adapters\UsuarioPDOAdapter;

class UsuarioRepository implements UsuarioRepositoryInterface
{
    public function __construct(private readonly UsuarioPDOAdapter $PDOAdapter){}

    /**
     * @param Usuario $usuario
     * @return Usuario
     */
    public function adicionar(Usuario $usuario): Usuario
    {
        return $this->PDOAdapter->adicionar($usuarioDTO);
    }

    /**
     * @param int $usuarioId
     * @return bool
     */
    public function remover(int $usuarioId): bool
    {
        return $this->PDOAdapter->remover($usuarioId);
    }

    /**
     * @param UsuarioDTO $usuarioDTO
     * @param int $usuarioID
     * @return void
     */
    public function editar(UsuarioDTO $usuarioDTO, int $usuarioID): void
    {
        $this->PDOAdapter->editar($usuarioDTO, $usuarioID);
    }

    /**
     * @param int $usuarioID
     * @return Usuario
     */
    public function getUsuarioById(int $usuarioID): Usuario
    {
        return $this->PDOAdapter->getUsuarioById($usuarioID);
    }
}