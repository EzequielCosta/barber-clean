<?php

namespace App\Application\UseCases\Usuario;

use App\Application\Factories\UsuarioFactory;
use App\Domain\DTOs\UsuarioDTO;
use App\Domain\Entities\Usuario;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Infra\Repositories\UsuarioPDORepository;

class EditarUsuarioUseCase
{
    public function __construct(private UsuarioRepositoryInterface $usuarioRepository, private UsuarioFactory $usuarioFactory)
    {
    }

    /**
     * @param UsuarioDTO $usuarioDTO
     * @param int $usuarioId
     * @return Usuario|null
     */
    public function handle(UsuarioDTO $usuarioDTO, int $usuarioId): ?Usuario
    {
        try {
            $this->usuarioRepository->editar($usuarioDTO, $usuarioId);
        } catch (\Exception $exception) {
            return null;
        }

        return $this->usuarioFactory->fromDTO($usuarioDTO);
    }
}