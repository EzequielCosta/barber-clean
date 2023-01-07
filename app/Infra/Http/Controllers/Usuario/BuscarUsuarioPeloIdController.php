<?php

namespace App\Infra\Http\Controllers\Usuario;

use App\Application\UseCases\Usuario\BuscarUsuarioPeloId\BuscarUsuarioPeloIdUseCase;
use App\Domain\Exceptions\RegistroNaoEncontrado;
use App\Infra\Http\Controllers\PresenterInterface;
use App\Infra\Http\Requests\RequestInterface;
use App\Infra\Http\Responses\ResponseInterface;

class BuscarUsuarioPeloIdController
{
    public function __construct(
        private readonly BuscarUsuarioPeloIdUseCase $useCase,
        private readonly ResponseInterface   $response
    )
    {
    }

    /**
     * @throws RegistroNaoEncontrado
     */
    public function handle(PresenterInterface $presenter, int $usuarioId): void
    {
        $output = $this->useCase->handle($usuarioId);

        $outputPresenter =  $presenter->handle([
            "id" => $output->id,
            "telefone" => $output->telefone,
            "email" => $output->email,
            "nome" => $output->nome,
            "profile" => $output->profile,
            "bairro" => $output->bairro,
            "logradouro" => $output->logradouro,
            "numero" => $output->numero,
        ]);

        $this->response->setStatusCode(203);

        $this->response->json([
            "user" => $output
        ]);

    }


}