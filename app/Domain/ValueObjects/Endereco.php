<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

class Endereco
{
    public string $logradouro;
    public string $numero;
    public string $cep;
    public string $bairro;

    public function __construct(string $logradouro, string $numero, string $cep, string $bairro)
    {
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->cep = $cep;
        $this->bairro = $bairro;
    }
}