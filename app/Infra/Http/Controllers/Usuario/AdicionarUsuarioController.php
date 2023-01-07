<?php

namespace App\Infra\Http\Controllers;

use App\Application\UseCases\Usuario\AdicionarUsuario\AdicionarUsuarioUseCase;
use App\Application\UseCases\Usuario\AdicionarUsuario\InputDTO;
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
        private RequestInterface        $request,
        private ResponseInterface       $response
    )
    {
    }

    /**
     * @throws InvalidValueException
     */
    public function handle(PresenterInterface $presenter): string
    {
        $dataRequest = $this->request->data();

        $input = new InputDTO(
            $dataRequest["nome"],
            $dataRequest["email"],
            $dataRequest["telefone"],
            $dataRequest["profile"],
            $dataRequest["logradouro"],
            $dataRequest["numero"],
            $dataRequest["cep"],
            $dataRequest["bairro"],
        );

        $output = $this->useCase->handle($input);

        return $presenter->handle([
            "id" => $output->id,
            "telefone" => $output->telefone,
            "email" => $output->email,
            "nome" => $output->nome,
            "profile" => $output->profile,
            "bairro" => $output->bairro,
            "logradouro" => $output->logradouro,
            "numero" => $output->numero,
        ]);
    }
}