<?php

namespace App\Application\Factories;

use App\Domain\DTOs\ServicoDTO;
use App\Domain\Entities\Usuario;

class UsuarioFactory
{
    /**
     * @param ServicoDTO $usuarioDTO
     * @return Usuario
     */
    public function fromDTO(ServicoDTO $usuarioDTO): Usuario
    {
        return new Usuario(
            nome: $usuarioDTO->nome,
            telefone: $usuarioDTO->telefone,
            createdAt: $usuarioDTO->createdAt,
            updatedAt: $usuarioDTO->updatedAt,
            profile: $usuarioDTO->profile,
            email: $usuarioDTO->email,
            endereco: $usuarioDTO->endereco,
        );
    }
}