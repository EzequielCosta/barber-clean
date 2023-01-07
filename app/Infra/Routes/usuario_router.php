<?php

use App\Application\UseCases\Usuario\AdicionarUsuario\AdicionarUsuarioUseCase;
use App\Application\UseCases\Usuario\BuscarUsuarioPeloId\BuscarUsuarioPeloIdUseCase;
use App\Infra\Connections\PDOConnection;
use App\Infra\Http\Controllers\Usuario\AdicionarUsuarioController;
use App\Infra\Http\Controllers\Usuario\BuscarUsuarioPeloIdController;
use App\Infra\Http\Controllers\Usuario\EditarUsuarioController;
use App\Infra\Http\Controllers\Usuario\RemoverUsuarioController;
use App\Infra\Presenters\AdicionarUsuarioPresenter;
use App\Infra\Presenters\JsonPresenter;
use App\Infra\Repositories\UsuarioPDORepository;
use Pecee\Http\Request;
use Pecee\Http\Response;
use Pecee\SimpleRouter\SimpleRouter;


SimpleRouter::group(["prefix" => '/usuario'], function () {

    SimpleRouter::get('/{id}', function (int $userId) {

        $requestSimpleRouter = new Request();
        $responseSimpleRouter = new Response($requestSimpleRouter);
        $response = new \App\Infra\Http\Responses\SimpleRouterResponse($responseSimpleRouter);

        try {

            $PDO = (new PDOConnection())->connect(getenv("DATABASE_DRIVER"));

            $repository = new UsuarioPDORepository($PDO);
            $useCase = new BuscarUsuarioPeloIdUseCase($repository);

            $controller = new BuscarUsuarioPeloIdController($useCase, $response);
            $presenter = new JsonPresenter();

            $controller->handle($presenter, $userId);


        } catch (Exception|Error $exception) {
            $response->setStatusCode(500);
            $response->json([
                "error" => $exception->getMessage()
            ]);
        }

    });

    SimpleRouter::post('/save', function () {

        $requestSimpleRouter = new Request();
        $responseSimpleRouter = new Response($requestSimpleRouter);
        $request = new \App\Infra\Http\Requests\SimpleRouterRequest($requestSimpleRouter);
        $response = new \App\Infra\Http\Responses\SimpleRouterResponse($responseSimpleRouter);


        try {

            $PDO = (new PDOConnection())->connect(getenv("DATABASE_DRIVER"));

            $repository = new UsuarioPDORepository($PDO);
            $useCase = new AdicionarUsuarioUseCase($repository);

            $controller = new AdicionarUsuarioController($useCase, $request, $response);
            $presenter = new AdicionarUsuarioPresenter();
            $controller->handle($presenter);

        } catch (Exception|Error $exception) {
            $response->setStatusCode(500);
            $response->json([
                "error" => $exception->getMessage()
            ]);
        }

    });

    SimpleRouter::delete('/{id}/delete', function (int $userId) {

        $requestSimpleRouter = new Request();
        $responseSimpleRouter = new Response($requestSimpleRouter);
        $response = new \App\Infra\Http\Responses\SimpleRouterResponse($responseSimpleRouter);

        try {

            $PDO = (new PDOConnection())->connect(getenv("DATABASE_DRIVER"));

            $repository = new UsuarioPDORepository($PDO);
            $useCase = new \App\Application\UseCases\Usuario\RemoverUsuario\RemoverUsuarioUseCase($repository);

            $controller = new RemoverUsuarioController($useCase, $response);
            $presenter = new JsonPresenter();

            $controller->handle($presenter, $userId);


        } catch (Exception|Error $exception) {
            $response->setStatusCode(500);
            $response->json([
                "error" => $exception->getMessage()
            ]);
        }

    });

    SimpleRouter::post('/{id}/edit' , function (int $userId) {

        $requestSimpleRouter = new Request();
        $responseSimpleRouter = new Response($requestSimpleRouter);
        $request = new \App\Infra\Http\Requests\SimpleRouterRequest($requestSimpleRouter);
        $response = new \App\Infra\Http\Responses\SimpleRouterResponse($responseSimpleRouter);

        try {

            $PDO = (new PDOConnection())->connect(getenv("DATABASE_DRIVER"));

            $repository = new UsuarioPDORepository($PDO);
            $useCase = new \App\Application\UseCases\Usuario\EditarUsuario\EditarUsuarioUseCase($repository);

            $controller = new EditarUsuarioController($request, $response, $useCase);
            $presenter = new JsonPresenter();

            $controller->handle($presenter, $userId);


        } catch (Exception|Error $exception) {
            $response->setStatusCode(500);
            $response->json([
                "error" => $exception->getMessage()
            ]);
        }
    });


});