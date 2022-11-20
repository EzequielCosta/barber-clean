<?php

namespace App\Application\Factories;

use App\Domain\DTOs\ServicoDTO;
use App\Domain\DTOs\UsuarioDTO;
use App\Domain\Entities\Usuario;
use App\Domain\Exceptions\InvalidValueException;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Endereco;
use App\Domain\ValueObjects\Telefone;

class UsuarioFactory
{
    /**
     * @param UsuarioDTO $usuarioDTO
     * @return Usuario
     */
    public function fromDTO(UsuarioDTO $usuarioDTO): Usuario
    {
        return new Usuario(
            id: $usuarioDTO->id,
            nome: $usuarioDTO->nome,
            telefone: $usuarioDTO->telefone,
            profile: $usuarioDTO->profile,
            email: $usuarioDTO->email,
            endereco: $usuarioDTO->endereco,
        );
    }

    /**
     * @param array $usuarioDados
     * @return Usuario
     * @throws InvalidValueException
     */
    public function fromArray(array $usuarioDados): Usuario
    {
        return new Usuario(
            nome: $usuarioDados["nome"],
            telefone: new Telefone($usuarioDados["telefone"]),
            profile: $usuarioDados["perfil_id"],
            email: new Email($usuarioDados["email"]),
            endereco: new Endereco(
                $usuarioDados["logradouro"],
                $usuarioDados["numero"],
                $usuarioDados["cep"],
                $usuarioDados["bairro"],
            ),
            id: $usuarioDados["id"]
        );
    }
}