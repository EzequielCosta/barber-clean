<?php

namespace App\Application\Factories;

use App\Domain\DTOs\ServicoDTO;
use App\Domain\Entities\Servico;
use App\Domain\Exceptions\InvalidValueException;

class ServicoFactory
{
    /**
     * @param ServicoDTO $servicoDTO
     * @return Servico
     * @throws InvalidValueException
     */
    public function fromDTO(ServicoDTO $servicoDTO): Servico
    {
        return new Servico(
            nome: $servicoDTO->nome,
            duracao: $servicoDTO->getDuracao(),
            valor: $servicoDTO->getValor()
        );
    }

    /**
     * @param array $dado
     * @return Servico
     * @throws InvalidValueException
     */
    public function fromArray(array $dado): Servico
    {
        return new Servico(
            nome: $dado["nome"],
            duracao: $dado["duracao"],
            valor: $dado["valor"],
            id: $dado["id"]
        );
    }
}