<?php
declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\Exceptions\InvalidValueException;
use DateTime;

final class Agendamento
{

    private float $valorTotal;

    /**
     * @param int|null $id
     * @param Usuario $cliente
     * @param Usuario $funcionario
     * @param float $valorTotal
     * @param DateTime $horario
     * @param DateTime $data
     * @param string $status
     * @param ServicosAgendamento $servicosAgendamento
     * @throws InvalidValueException
     */
    public function __construct(
        public readonly ?int                $id,
        public Usuario                      $cliente,
        public Usuario                      $funcionario,
        float                               $valorTotal,
        public DateTime                     $horario,
        public DateTime                     $data,
        public string                       $status,
        public readonly ServicosAgendamento $servicosAgendamento,
    )
    {
        $this->setValorTotal($valorTotal);
    }

    /**
     * @return float
     */
    function getValorTotal(): float
    {
        return $this->valorTotal;
    }

    /**
     * @param float $valor
     * @return void
     * @throws InvalidValueException
     */
    function setValorTotal(float $valor): void
    {
        if ($valor <= 0) {
            throw new InvalidValueException("O valor deverá ser positivo");
        }
        $this->valorTotal = $valor;
    }

}