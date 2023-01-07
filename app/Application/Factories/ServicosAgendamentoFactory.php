<?php

namespace App\Application\Factories;

use App\Domain\DTOs\ServicoAgendamentoDTO;
use App\Domain\Entities\ServicosAgendamento;

class ServicosAgendamentoFactory
{
    private ServicosAgendamento $servicosAgendamento;

    public function __construct()
    {
        $this->servicosAgendamento = new ServicosAgendamento();
    }

    public function fromDTO(ServicoAgendamentoDTO $servicosAgendamento){
        $items = [];
        foreach ($servicosAgendamento as $item){

            $this->servicosAgendamento->adicionar();
        }


    }
}