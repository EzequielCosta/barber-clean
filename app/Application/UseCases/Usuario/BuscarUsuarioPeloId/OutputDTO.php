<?php

namespace App\Application\UseCases\Usuario\BuscarUsuarioPeloId;

class OutputDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string  $nome,
        public readonly string $email,
        public readonly string $telefone,
        public readonly string  $profile,
        public readonly string $logradouro,
        public readonly string $numero,
        public readonly string $cep,
        public readonly string $bairro
    )
    {
    }
}