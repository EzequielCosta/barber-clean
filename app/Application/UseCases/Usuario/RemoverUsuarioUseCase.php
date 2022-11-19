<?php

namespace App\Application\UseCases\Usuario;

use App\Domain\Repositories\UsuarioRepositoryInterface;

class RemoverUsuarioUseCase
{
    public function __construct(
        private UsuarioRepositoryInterface $userRepository
    )
    {
    }

    public function handle(int $usuarioId): bool
    {
        return $this->userRepository->remover($usuarioId);
    }
}