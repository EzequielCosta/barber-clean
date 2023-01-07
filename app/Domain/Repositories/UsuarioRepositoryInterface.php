<?php
declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\DTOs\UsuarioDTO;
use App\Domain\Entities\Usuario;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Endereco;
use App\Domain\ValueObjects\Telefone;

interface UsuarioRepositoryInterface
{
    //public function adicionar(string $nome, Email $email, Telefone $telefone, string $profile, Endereco $endereco) : Usuario;
    public function adicionar(Usuario $usuario) : Usuario;
    public function remover(int $usuarioID): bool;
    public function editar(array $paramnsUsuario, int $usuarioID): Usuario|bool;
    public function getUsuarioById(int $usuarioID): Usuario|bool;

}