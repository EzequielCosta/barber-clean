<?php

namespace App\Application\UseCases\Usuario\AdicionarUsuario;

use App\Domain\DTOs\UsuarioDTO;
use App\Domain\Entities\Usuario;
use App\Domain\Exceptions\InvalidValueException;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Endereco;
use App\Domain\ValueObjects\Telefone;

class AdicionarUsuarioUseCase
{

    public function __construct(
        public UsuarioRepositoryInterface $userRepository
    ){}

    /**
     * @throws InvalidValueException
     */
    public function handle(InputDTO $input) : OutputDTO
    {
        $email = new Email($input->email);
        $telefone = new Telefone($input->telefone);
        $endereco = new Endereco($input->logradouro, $input->numero, $input->cep, $input->bairro);
        $usuarioEntity = new Usuario($input->nome, $telefone, $input->profile, $email, $endereco);
        $usuarioSaved = $this->userRepository->adicionar($usuarioEntity);

        return new OutputDTO(
            $usuarioSaved->id,
            $usuarioSaved->nome,
            (string) $usuarioSaved->email,
            (string) $usuarioSaved->telefone,
            $usuarioSaved->profile,
            $usuarioSaved->endereco->logradouro,
            $usuarioSaved->endereco->numero,
            $usuarioSaved->endereco->cep,
            $usuarioSaved->endereco->bairro
        );

    }
}