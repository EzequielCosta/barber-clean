<?php

namespace App\Application\UseCases\Usuario;

use App\Domain\Entities\Usuario;
use App\Domain\Repositories\UsuarioRepositoryInterface;

class BuscarUsuarioPeloIdUseCase
{
    public function __construct(private readonly UsuarioRepositoryInterface $usuarioRepository)
    {
    }

    /**
     * @param int $usuarioId
     * @return Usuario
     */
    public function handle(int $usuarioId) : Usuario
    {
        return $this->usuarioRepository->getUsuarioById($usuarioId);
    }
}