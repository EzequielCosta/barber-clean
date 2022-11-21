<?php
declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\Exceptions\InvalidValueException;

final class Servico
{
    public readonly ?int $id;
    public string $nome;
    private int $duracao;
    private float $valor;

    /**
     * @param string $nome
     * @param int $duracao
     * @param float $valor
     * @param int|null $id
     * @throws InvalidValueException
     */
    public function __construct( string $nome, int $duracao, float $valor,  ?int $id = null)
    {
        $this->nome = $nome;
        $this->setDuracao($duracao);
        $this->setValor($valor);
        $this->id = $id;
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