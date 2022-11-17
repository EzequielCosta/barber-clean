<?php
declare(strict_types=1);

namespace App\Domain\Entities;

final class ServicoAgendamento
{

    public function __construct(
        public Agendamento $agendamento,
        public Servico $servico,
        public ?\DateTime $createdAt,
        public ?\DateTime $updatedAt
    ){}
}