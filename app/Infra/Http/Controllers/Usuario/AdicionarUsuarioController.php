<?php

namespace App\Infra\Http\Controllers\Usuario;

use App\Application\UseCases\Usuario\AdicionarUsuario\AdicionarUsuarioUseCase;
use App\Application\UseCases\Usuario\AdicionarUsuario\InputDTO;
use App\Domain\Exceptions\InvalidValueException;
use App\Infra\Http\Controllers\PresenterInterface;
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
    public function handle(PresenterInterface $presenter): void

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

        $outputPresenter = $presenter->handle([
            "id" => $output->id,
            "telefone" => $output->telefone,
            "email" => $output->email,
            "nome" => $output->nome,
            "profile" => $output->profile,
            "bairro" => $output->bairro,
            "logradouro" => $output->logradouro,
            "numero" => $output->numero,
        ]);

        $this->response->setStatusCode("203");
        $this->response->json([
                "user" => $outputPresenter
            ]
        );
    }
}