<?php

namespace App\Infra\Repositories;

use App\Domain\DTOs\ServicoDTO;
use App\Domain\Entities\Usuario;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Infra\Adapters\UsuarioPDOAdapter;

class UsuarioRepository implements UsuarioRepositoryInterface
{
    public function __construct(private readonly UsuarioPDOAdapter $PDOAdapter){}

    /**
     * @param ServicoDTO $usuarioDTO
     * @return Usuario
     */
    public function adicionar(ServicoDTO $usuarioDTO): Usuario
    {
        return $this->PDOAdapter->adicionar($usuarioDTO);
    }

    /**
     * @param int $usuarioId
     * @return bool
     */
    public function remover(int $usuarioId): bool
    {
        return $this->PDOAdapter->remover($usuarioId);
    }

    /**
     * @param ServicoDTO $usuarioDTO
     * @param int $usuarioID
     * @return void
     */
    public function editar(ServicoDTO $usuarioDTO, int $usuarioID): void
    {
        $this->PDOAdapter->editar($usuarioDTO, $usuarioID);
    }
}