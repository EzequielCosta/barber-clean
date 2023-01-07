<?php

use App\Application\UseCases\Agendamento\AgendarServicoUseCase;
use App\Application\UseCases\Servico\BuscarServicoPeloIdUseCase;
use App\Application\UseCases\Usuario\BuscarUsuarioPeloId\BuscarUsuarioPeloIdUseCase;
use App\Domain\DTOs\AgendamentoDTO;
use App\Infra\Adapters\AgendamentoPostgresPDOAdapter;
use App\Infra\Adapters\ServicoPostgresPDOAdapter;
use App\Infra\Adapters\UsuarioPostgresPDOAdapter;
use App\Infra\Connections\PDOConnection;
use App\Infra\Repositories\AgendamentoRepository;
use App\Infra\Repositories\ServicoRepository;
use App\Infra\Repositories\UsuarioPDORepository;

require_once __DIR__.'/../vendor/autoload.php';

$configConstants = require_once __DIR__.'/../configs/constants.php';

$PDO = (new PDOConnection())->connect("postgres");
$usuarioPostgresPDOAdapter = new UsuarioPostgresPDOAdapter($PDO);
$usuarioRepositorio = new UsuarioPDORepository($usuarioPostgresPDOAdapter);
$buscarUsuarioPeloIdUseCase = new BuscarUsuarioPeloIdUseCase($usuarioRepositorio);


$servicoPostgresPDOAdapter = new ServicoPostgresPDOAdapter($PDO);
$servicoRepository = new ServicoRepository($servicoPostgresPDOAdapter);
$buscarServicoPeloIdUseCase = new BuscarServicoPeloIdUseCase($servicoRepository);

$funcionario = $buscarUsuarioPeloIdUseCase->handle(2);
$cliente = $buscarUsuarioPeloIdUseCase->handle(3);

$servico1 = $buscarServicoPeloIdUseCase->handle(4);
$servico2 = $buscarServicoPeloIdUseCase->handle(5);

$servicos = new \App\Domain\Entities\Servicos();
$servicos->adicionar($servico1);
$servicos->adicionar($servico2);

$agendamentoDTO = new AgendamentoDTO(
    cliente: $cliente,
    funcionario: $funcionario,
    valorTotal: 100,
    horario:DateTime::createFromFormat(' H:i:ss', date(' H:i:ss')),
    data: DateTime::createFromFormat(' H:i:ss', date(' H:i:ss')),
    status: $configConstants["status"]["PENDENTE"],
    servicos: $servicos
);

$agendamentoPostgresPDOAdapter = new AgendamentoPostgresPDOAdapter($PDO);
$agendamentoRepository = new AgendamentoRepository($agendamentoPostgresPDOAdapter);
$agendarServicos = new AgendarServicoUseCase($agendamentoRepository);
$agendarServicos->handle($agendamentoDTO);


