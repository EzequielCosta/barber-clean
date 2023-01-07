<?php

namespace App\Application\UseCases\Usuario\BuscarUsuarioPeloId;

use App\Domain\Entities\Usuario;
use App\Domain\Exceptions\RegistroNaoEncontrado;
use App\Domain\Repositories\UsuarioRepositoryInterface;

class BuscarUsuarioPeloIdUseCase
{
    public function __construct(private readonly UsuarioRepositoryInterface $usuarioRepository)
    {
    }

    /**
     * @param int $usuarioId
     * @return Usuario
     * @throws RegistroNaoEncontrado
     */
    public function handle(int $usuarioId): Usuario
    {
        $usuario = $this->usuarioRepository->getUsuarioById($usuarioId);

        if ($usuario === false) {
            throw new RegistroNaoEncontrado("Usuário não encontrado");
        }

        return $usuario;
    }
}