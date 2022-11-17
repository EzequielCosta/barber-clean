<?php

namespace App\Application\UseCases\Usuario;

use App\Domain\DTOs\ServicoDTO;
use App\Domain\Entities\Usuario;
use App\Domain\Repositories\UsuarioRepositoryInterface;

class AdicionarUsuarioUseCase
{

    public function __construct(
        public UsuarioRepositoryInterface $userRepository
    ){}

    public function handle(ServicoDTO $usuarioDTO) : Usuario
    {
        return $this->userRepository->adicionar($usuarioDTO);
    }
}