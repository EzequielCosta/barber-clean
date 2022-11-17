<?php
declare(strict_types=1);

namespace App\Domain\ValueObjects;

use App\Domain\Exceptions\InvalidValueException;

class Telefone
{
    private string $valor;

    /**
     * @throws InvalidValueException
     */
    public function __construct(string $valor)
    {
        $this->setValor($valor);
    }

    /**
     * @param string $valor
     * @return bool
     */
    public function validate(string $valor): bool
    {
        return strlen($valor) === 11;
    }

    /**
     * @return string
     */
    public function getValor(): string
    {
        return $this->valor;
    }

    /**
     * @param string $valor
     * @return void
     * @throws InvalidValueException
     */
    public function setValor(string $valor): void
    {

        if (!$this->validate($valor)) {
            throw new InvalidValueException(message: "Phone invalid.");
        }

        $this->valor = $valor;
    }
}