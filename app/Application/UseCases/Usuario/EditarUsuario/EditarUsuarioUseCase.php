<?php

namespace App\Application\UseCases\Usuario\EditarUsuario;

use App\Application\Factories\UsuarioFactory;
use App\Domain\DTOs\UsuarioDTO;
use App\Domain\Entities\Usuario;
use App\Domain\Exceptions\InvalidValueException;
use App\Domain\Exceptions\RegistroNaoEncontrado;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Endereco;
use App\Domain\ValueObjects\Telefone;

class EditarUsuarioUseCase
{
    public function __construct(private UsuarioRepositoryInterface $usuarioRepository)
    {
    }

    /**
     * @param InputDTO $inputDTO
     * @param int $usuarioId
     * @return Usuario
     * @throws InvalidValueException
     * @throws RegistroNaoEncontrado
     */
    public function handle(InputDTO $inputDTO, int $usuarioId): OutputDTO
    {
        $data = [];

        if ($inputDTO->email)  $data["email"] = (string) new Email($inputDTO->email);
        if ($inputDTO->telefone) $data["telefone"] = (string) new Telefone($inputDTO->telefone);
        if ($inputDTO->logradouro) $data["logradouro"] = $inputDTO->logradouro;
        if ($inputDTO->numero) $data["numero"] = $inputDTO->numero;
        if ($inputDTO->cep) $data["cep"] = $inputDTO->cep;
        if ($inputDTO->bairro) $data["bairro"] = $inputDTO->bairro;
        if ($inputDTO->nome) $data["nome"] = $inputDTO->nome;
        if ($inputDTO->profile) $data["profile"] = $inputDTO->profile;

        $userEdited = $this->usuarioRepository->editar($data, $usuarioId);

        if ($userEdited === false){
            throw new RegistroNaoEncontrado("Usuário não encontrado");
        }

        return new OutputDTO(
            $userEdited->id,
            $userEdited->nome,
            (string) $userEdited->email,
            (string) $userEdited->telefone,
            $userEdited->profile,
            $userEdited->endereco->logradouro,
            $userEdited->endereco->numero,
            $userEdited->endereco->cep,
            $userEdited->endereco->bairro
        );
    }
}