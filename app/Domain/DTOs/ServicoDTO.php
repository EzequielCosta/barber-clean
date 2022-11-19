<?php

namespace App\Domain\DTOs;

use App\Domain\Exceptions\InvalidValueException;

final class ServicoDTO
{

    private ?int $duracao;
    private ?float $valor;


    /**
     * @param string|null $nome
     * @param int|null $duracao
     * @param float|null $valor
     * @throws InvalidValueException
     */
    public function __construct(public ?string $nome, ?int $duracao, ?float $valor,)
    {
        $this->setValor($valor);
        $this->setDuracao($duracao);
    }

    /**
     * @param int|null $valor
     * @return void
     * @throws InvalidValueException
     */
    public function setDuracao(?int $valor): void
    {
        if ($valor !== null && $valor <= 0) {
            throw new InvalidValueException("O valor deverá ser maior que zero ");
        }

        $this->duracao = $valor;
    }

    /**
     * @param float|null $valor
     * @return void
     * @throws InvalidValueException
     */
    public function setValor(?float $valor): void
    {
        if ($valor !== null && $valor <= 0) {
            throw new InvalidValueException("O valor deverá ser maior que zero.");
        }

        $this->valor = $valor;
    }

    /**
     * @return int
     */
    public function getDuracao(): ?int
    {
        return $this->duracao;
    }

    /**
     * @return float
     */
    public function getValor(): ?float
    {
        return $this->valor;
    }

    /**
     * @return array
     */
    public function attributesFilled(): array
    {
        $attributes = get_object_vars($this);
        $attributesFilled = [];

        foreach ($attributes as $attributeName => $attributeValue) {
            if ($attributeValue !== null && $attributeValue !== '') {
                $attributesFilled[$attributeName] = $attributeValue;
            }
        }

        return $attributesFilled;
    }

}