<?php

namespace App\Domain\DTOs;

use App\Domain\Entities\Profile;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Endereco;
use App\Domain\ValueObjects\Telefone;

final class UsuarioDTO
{
    public function __construct(
        public ?string   $nome,
        public ?Email    $email,
        public ?Telefone $telefone,
        public ?string   $profile,
        public ?Endereco $endereco,
        public ?int      $id = null
    )
    {
    }
}