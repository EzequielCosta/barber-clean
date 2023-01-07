<?php

namespace App\Infra\Http\Controllers\Usuario;

use App\Application\UseCases\Usuario\RemoverUsuario\RemoverUsuarioUseCase;
use App\Domain\Exceptions\RegistroNaoEncontrado;
use App\Infra\Http\Controllers\PresenterInterface;
use App\Infra\Http\Responses\ResponseInterface;

class RemoverUsuarioController
{
    public function __construct(
        private readonly RemoverUsuarioUseCase $useCase,
        private readonly ResponseInterface $response
    )
    {
    }

    /**
     * @param PresenterInterface $presenter
     * @param int $ususuarioId
     * @return void
     * @throws RegistroNaoEncontrado
     */
    public function handle(PresenterInterface $presenter, int $ususuarioId) : void
    {
        $output = $this->useCase->handle($ususuarioId);

        $this->response->json([
            "deleted" => $output
        ]);

    }
}