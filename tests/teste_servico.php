<?php

use App\Application\Factories\ServicoFactory;
use App\Application\UseCases\Servico\AdicionarServicoUseCase;
use App\Application\UseCases\Servico\EditarServicoUseCase;
use App\Application\UseCases\Servico\RemoverServicoUseCase;
use App\Domain\DTOs\ServicoDTO;
use App\Domain\Exceptions\PDOConnectionException;
use App\Infra\Adapters\ServicoPostgresPDOAdapter;
use App\Infra\Connections\PDOConnection;
use App\Infra\Repositories\ServicoRepository;

require_once __DIR__ . '/../vendor/autoload.php';



try {
    // Adicionar Servico

    $PDO = (new PDOConnection())->connect("postgres");

    $servicoPostgresPDOAdapter = new ServicoPostgresPDOAdapter($PDO);
    $servicoRepository = new ServicoRepository($servicoPostgresPDOAdapter);
    $servicoFactory = new ServicoFactory();

    $servicoDTO = new ServicoDTO('Corte na máquina', 40, 25.0);

    $adicionarServicoUseCase = new AdicionarServicoUseCase($servicoRepository, $servicoFactory);

    //$servicoAdicionado = $adicionarServicoUseCase->handle($servicoDTO);
    //echo $servicoAdicionado ? 'Serviço adicionado' : 'Não foi possível adicionar o servico';

    // Remover Servico

    //$removerServicoUseCase = new RemoverServicoUseCase($servicoRepository);

//    $servicoRemovido = $removerServicoUseCase->handle(3);
//    echo $servicoRemovido ? 'Serviço removido' : 'Não foi possível remover o servico';

    //Editar Servico

    $editarServicoUseCase = new EditarServicoUseCase($servicoRepository, $servicoFactory);
    $servicoDTO2 = new ServicoDTO("Corte na navalha",40, valor: 50.0);
    $servicoRemovido = $editarServicoUseCase->handle($servicoDTO2, 1);
    echo $servicoRemovido ? 'Serviço editado'.PHP_EOL : 'Não foi possível editar o servico'.PHP_EOL;

} catch (\Exception $e) {
    echo $e->getMessage();
}




