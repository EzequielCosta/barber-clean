<?php
declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\Exceptions\InvalidValueException;

final class Servico
{
    public string $nome;
    private int $duracao;
    private float $valor;

    /**
     * @param string $nome
     * @param int $duracao
     * @param float $valor
     * @param \DateTime|null $createdAt
     * @param \DateTime|null $updatedAt
     * @throws InvalidValueException
     */
    public function __construct(string $nome, int $duracao, float $valor, public ?\DateTime $createdAt, public ?\DateTime $updatedAt)
    {
        $this->nome = $nome;
        $this->setDuracao($duracao);
        $this->setValor($valor);
    }

    /**
     * @param int $valor
     * @return void
     * @throws InvalidValueException
     */
    public function setDuracao(int $valor): void
    {
        if ($valor <= 0){
            throw new InvalidValueException("O valor deverá ser maior que zero ");
        }

        $this->duracao = $valor;
    }

    /**
     * @param float $valor
     * @return void
     * @throws InvalidValueException
     */
    public function setValor(float $valor): void
    {
        if ($valor <= 0){
            throw new InvalidValueException("O valor deverá ser maior que zero.");
        }

        $this->valor = $valor;
    }

}