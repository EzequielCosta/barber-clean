<?php

use App\Infra\Adapters\UsuarioPostgresPDOAdapter;
use App\Infra\Connections\PDOConnection;
use App\Infra\Http\Controllers\AdicionarUsuarioController;
use App\Infra\Presenters\AdicionarUsuarioPresenter;
use App\Infra\Repositories\UsuarioRepository;
use Pecee\Http\Request;
use Pecee\Http\Response;
use Pecee\SimpleRouter\SimpleRouter;


SimpleRouter::group(["prefix" => '/usuario'], function () {

    SimpleRouter::get('/', function () {
        echo 'Visualizar Usuário';
    });

    SimpleRouter::get('/create', function () {
        echo 'Cadastrar Usuário';
    });

    //SimpleRouter::post('/edit', [AdicionarUsuarioController::class,'handle']);

    SimpleRouter::post('/save', function () {

        $requestSimpleRouter = new Request();
        $responseSimpleRouter = new Response($requestSimpleRouter);
        $request = new \App\Infra\Http\Requests\SimpleRouterRequest($requestSimpleRouter);
        $response = new \App\Infra\Http\Responses\SimpleRouterResponse($responseSimpleRouter);

        $PDO = (new PDOConnection())->connect(getenv("DATABASE_DRIVER"));
        $usuarioPostgresPDOAdapter = new UsuarioPostgresPDOAdapter($PDO);
        $repository = new UsuarioRepository($usuarioPostgresPDOAdapter);
        $useCase = new \App\Application\UseCases\Usuario\AdicionarUsuarioUseCase($repository);

        $controller = new AdicionarUsuarioController($useCase, $request, $response);
        $presenter = new AdicionarUsuarioPresenter();
        $output = $controller->handle($presenter);
        $response->setStatusCode(203);
        $response->setHeaders([
            "contentType" => "application/json"
        ]);

        return $response;
    });

    SimpleRouter::delete('/delete', function () {
        echo 'Deletar Usuário';
    });


});