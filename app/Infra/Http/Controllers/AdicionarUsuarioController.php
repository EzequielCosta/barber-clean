<?php

namespace App\Infra\Http\Controllers;

use App\Application\UseCases\Usuario\AdicionarUsuarioUseCase;
use App\Domain\DTOs\UsuarioDTO;
use App\Domain\Exceptions\InvalidValueException;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Endereco;
use App\Domain\ValueObjects\Telefone;
use App\Infra\Http\Requests\RequestInterface;
use App\Infra\Http\Responses\ResponseInterface;

class AdicionarUsuarioController
{
    public function __construct(
        private AdicionarUsuarioUseCase $useCase,
        private RequestInterface $request,
        private  ResponseInterface  $response
    )
    {
    }

    /**
     * @throws InvalidValueException
     */
    public function handle(PresenterInterface $presenter): string
    {
        $dataRequest = $this->request->data();
        $endereco = new Endereco(
            $dataRequest["logradouro"],
            $dataRequest["numero"],
            $dataRequest["cep"],
            $dataRequest["bairro"]
        );
        $email = new Email($dataRequest["email"]);
        $telefone = new Telefone($dataRequest["telefone"]);
        $usuarioDTO = new UsuarioDTO(
            nome: $dataRequest["nome"],
            email: $email,
            telefone: $telefone,
            profile: $dataRequest["profile"],
            endereco: $endereco
        );

        $output = $this->useCase->handle($usuarioDTO);

        return $presenter->handle([
            $output->telefone->getValor(),
            $output->email->getValor(),
            $output->nome,
            $output->profile,
            $output->endereco->bairro,
            $output->endereco->logradouro,
            $output->endereco->numero,
        ]);
    }
}