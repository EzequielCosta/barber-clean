<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Application\UseCases\Usuario\AdicionarUsuarioUseCase;
use App\Domain\DTOs\UsuarioDTO;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Endereco;
use App\Domain\ValueObjects\Telefone;
use App\Infra\Adapters\UsuarioPostgresPDOAdapter;
use App\Infra\Repositories\UsuarioRepository;


$PERFIL_ADMINISTRADOR = '1';
$PERFIL_CLIENTE = '4';

$profileConfig = require_once __DIR__ . '/../configs/user_profiles.php';

$endereco = new Endereco(
    'Rua Alice Fernandes',
    '2091',
    '54004320',
    'Vermelha'
);

$timestampCurrent = DateTime::createFromFormat('Y-m-d H:m:i', date('Y-m-d H:m:i'));


try {
    $usuarioDTO = new UsuarioDTO(
        nome: "Carlos Henrique do Nascimento",
        email: new Email("carlos@example.com"),
        telefone: new Telefone("86999776644"),
//        createdAt: $timestampCurrent,
//        updatedAt: $timestampCurrent,
        profile: $profileConfig["CLIENTE"],
        endereco: $endereco,
    );
} catch (\App\Domain\Exceptions\InvalidValueException $e) {
    echo $e->getMessage();
}

$dataBaseConfig = require_once __DIR__ . '/../configs/database.php';
$postgresConfig = $dataBaseConfig["drives"]["postgres"];


$PDO = new PDO(
    "pgsql:host={$postgresConfig["host"]};port={$postgresConfig["port"]};dbname={$postgresConfig["database"]}",
    username: $postgresConfig["username"],
    password: $postgresConfig["password"],

);

$postgresAdpater = new UsuarioPostgresPDOAdapter($PDO);
$usuarioRepository = new UsuarioRepository($postgresAdpater);
$adicionarUsuarioUseCase = new AdicionarUsuarioUseCase($usuarioRepository);
$adicionarUsuarioUseCase->handle($usuarioDTO);

//$removerUsuarioUseCase = new RemoverUsuarioUseCase($usuarioRepository);
//echo $removerUsuarioUseCase->handle(1) ? 'Removido'.PHP_EOL : 'Não removido'.PHP_EOL;


try {
    $usuarioDTO2 = new UsuarioDTO(
        nome: "Ezequiel Teixeira Costa",
        email: new Email("ezequielcosta@example.com"),
        telefone: new Telefone("86999445566"),
//        createdAt: $timestampCurrent,
//        updatedAt: $timestampCurrent,
        profile: $PERFIL_ADMINISTRADOR,
        endereco: $endereco,
    );
} catch (\App\Domain\Exceptions\InvalidValueException $e) {
    echo $e->getMessage();
}

$usuarioFactory = new \App\Application\Factories\UsuarioFactory();


$editarUsuarioUseCase = new \App\Application\UseCases\Usuario\EditarUsuarioUseCase($usuarioRepository, $usuarioFactory);
///$usuarioAtualizado = $editarUsuarioUseCase->handle($usuarioDTO2, 2);

//echo $usuarioAtualizado !== null ? 'Usuário Atualizado' . PHP_EOL : 'Erro ao Atualizar' . PHP_EOL;




