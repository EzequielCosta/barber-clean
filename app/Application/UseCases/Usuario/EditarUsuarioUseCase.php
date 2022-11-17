<?php

namespace App\Application\UseCases\Usuario;

use App\Application\Factories\UsuarioFactory;
use App\Domain\DTOs\ServicoDTO;
use App\Domain\Entities\Usuario;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Infra\Repositories\UsuarioRepository;

class EditarUsuarioUseCase
{
    public function __construct(private UsuarioRepositoryInterface $usuarioRepository, private UsuarioFactory $usuarioFactory)
    {
    }

    /**
     * @param ServicoDTO $usuarioDTO
     * @param int $usuarioId
     * @return Usuario|null
     */
    public function handle(ServicoDTO $usuarioDTO, int $usuarioId): ?Usuario
    {
        try {
            $this->usuarioRepository->editar($usuarioDTO, $usuarioId);
        } catch (\Exception $exception) {
            return null;
        }

        return $this->usuarioFactory->fromDTO($usuarioDTO);
    }
}