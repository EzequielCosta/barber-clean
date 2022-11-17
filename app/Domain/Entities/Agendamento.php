<?php
declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\Exceptions\InvalidValueException;

final class Agendamento
{
//    public User $cliente;
//    public User $barbeiro;
//    public ?\DateTime $createdAt;
//    public ?\DateTime $updated_at;
//    public array $servicos;
    private float $valorTotal;
//    public \DateTime $horarioAgendamento;
//    public \DateTime $dataAgendamento;

    /**
     * @param Usuario $cliente
     * @param Usuario $barbeiro
     * @param \DateTime|null $createdAt
     * @param \DateTime|null $updatedAt
     * @param array $servicos
     * @param float $valorTotal
     * @param \DateTime $horario
     * @param \DateTime $data
     * @throws InvalidValueException
     */
    public function __construct(
        public Usuario    $cliente,
        public Usuario    $barbeiro,
        public ?\DateTime $createdAt,
        public ?\DateTime $updatedAt,
        public array      $servicos,
        float             $valorTotal,
        public \DateTime  $horario,
        public \DateTime $data,
        public string $status,
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
        if ($valor <= 0){
            throw new InvalidValueException("O valor deverá ser positivo");
        }
        $this->valorTotal = $valor;
    }

}