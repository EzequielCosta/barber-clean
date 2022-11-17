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
            valor: $servicoDTO->getValor(),
            createdAt: $servicoDTO->createdAt,
            updatedAt: $servicoDTO->updatedAt
        );
    }
}