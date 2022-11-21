<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\ValueObjects\Endereco;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Telefone;

final class Usuario
{
    public readonly ?int $id;
    public string $nome;
    public ?Email $email;
    public Telefone $telefone;
    public string $profile;
    public ?Endereco $endereco;


    public function __construct(string $nome, Telefone $telefone, string $profile, ?Email $email, ?Endereco $endereco, ?int $id = null)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->profile = $profile;
        $this->endereco = $endereco;
        $this->id = $id;
    }
}