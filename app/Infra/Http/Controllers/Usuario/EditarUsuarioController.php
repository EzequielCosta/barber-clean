<?php

namespace App\Infra\Http\Controllers\Usuario;

use App\Application\UseCases\Usuario\EditarUsuario\EditarUsuarioUseCase;
use App\Application\UseCases\Usuario\EditarUsuario\InputDTO;
use App\Domain\Exceptions\InvalidValueException;
use App\Infra\Http\Requests\RequestInterface;
use App\Infra\Http\Responses\ResponseInterface;
use App\Infra\Presenters\JsonPresenter;

class EditarUsuarioController
{
    public function __construct(
        private RequestInterface     $request,
        private ResponseInterface    $response,
        private EditarUsuarioUseCase $useCase
    )
    {
    }

    public function handle(JsonPresenter $presenter, int $userId): void
    {
        $dados = $this->request->data();

        if (empty($dados)) {
            throw new InvalidValueException("Sem atributos para atualizar.");
        }

        $input = new InputDTO(
            $dados["nome"],
            $dados["email"],
            $dados["telefone"],
            $dados["profile"],
            $dados["logradouro"],
            $dados["numero"],
            $dados["cep"],
            $dados["bairro"],
        );

        $output = $this->useCase->handle($input, $userId);

        $outputPresenter = $presenter->handle([
            "id" => $output->id,
            "telefone" => (string) $output->telefone,
            "email" => (string) $output->email,
            "nome" => $output->nome,
            "profile" => $output->profile,
            "bairro" => $output->bairro,
            "logradouro" => $output->logradouro,
            "numero" => $output->numero,
        ]);

        $this->response->setStatusCode("200");

        $this->response->json(
            [
                "user" => $outputPresenter
            ]
        );

    }
}