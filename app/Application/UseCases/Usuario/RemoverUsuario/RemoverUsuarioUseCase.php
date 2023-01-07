<?php

namespace App\Application\UseCases\Usuario\RemoverUsuario;

use App\Domain\Exceptions\RegistroNaoEncontrado;
use App\Domain\Repositories\UsuarioRepositoryInterface;

class RemoverUsuarioUseCase
{
    public function __construct(
        private UsuarioRepositoryInterface $userRepository
    )
    {
    }

    /**
     * @throws RegistroNaoEncontrado
     */
    public function handle(int $usuarioId): bool
    {
        $usuarioDeletado =  $this->userRepository->remover($usuarioId);

        if (!$usuarioDeletado) {
            throw new RegistroNaoEncontrado("Usuário não encontrado");
        }

        return true;

    }
}