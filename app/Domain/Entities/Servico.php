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
     * @throws InvalidValueException
     */
    public function __construct(public readonly ?int $id, string $nome, int $duracao, float $valor)
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

    /**
     * @return float
     */
    public function getValor(): float
    {
        return $this->valor;
    }

}