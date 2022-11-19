<?php

namespace App\Application\Factories;

use App\Domain\DTOs\ServicoDTO;
use App\Domain\DTOs\UsuarioDTO;
use App\Domain\Entities\Usuario;

class UsuarioFactory
{
    /**
     * @param UsuarioDTO $usuarioDTO
     * @return Usuario
     */
    public function fromDTO(UsuarioDTO $usuarioDTO): Usuario
    {
        return new Usuario(
            nome: $usuarioDTO->nome,
            telefone: $usuarioDTO->telefone,
            profile: $usuarioDTO->profile,
            email: $usuarioDTO->email,
            endereco: $usuarioDTO->endereco,
        );
    }
}