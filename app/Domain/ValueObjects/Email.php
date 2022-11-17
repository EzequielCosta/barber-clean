<?php
declare(strict_types=1);

namespace App\Domain\ValueObjects;

use App\Domain\Exceptions\InvalidValueException;

class Email
{
    private string $valor;

    /**
     * @throws InvalidValueException
     */
    public function __construct(string $value)
    {
        $this->setValor($value);
    }

    /**
     * @param string $value
     * @return bool
     */
    public function validate(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
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
            throw new InvalidValueException(message: "Email Invalid.");
        }

        $this->valor = $valor;
    }
}