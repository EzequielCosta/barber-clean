<?php
declare(strict_types=1);

namespace App\Infra\Adapters;

use App\Application\Factories\UsuarioFactory;
use App\Domain\DTOs\UsuarioDTO;
use App\Domain\Entities\Usuario;
use App\Domain\Exceptions\DataBaseException;
use App\Domain\Exceptions\InvalidValueException;
use PDO;

class UsuarioPostgresPDOAdapter implements UsuarioPDOAdapter
{
    public function __construct(private PDO $PDO)
    {
    }

    /**
     * @param UsuarioDTO $userDTO
     * @return Usuario
     * @throws DataBaseException
     */
    public function adicionar(UsuarioDTO $userDTO): Usuario
    {

        $statementAdicionarUsuario = $this->PDO->prepare("insert into usuario (
                     nome, email, telefone, created_at, updated_at, logradouro, numero, cep, bairro, perfil_id) 
                values (:nome, :email,:telefone,:created_at,:updated_at, :logradouro,:numero,:cep,:bairro,:perfil_id)
            ");

        $usuarioAdicionado = $statementAdicionarUsuario->execute(
            [
                $userDTO->nome,
                $userDTO->email->getValor(),
                $userDTO->telefone->getValor(),
                date('Y-m-d H:m:i'),
                date('Y-m-d H:m:i'),
                $userDTO->endereco->logradouro,
                $userDTO->endereco->numero,
                $userDTO->endereco->cep,
                $userDTO->endereco->bairro,
                '1'
            ]
        );

        if (!$usuarioAdicionado) {
            throw new DataBaseException("Não foi possível adicionar o usuário");
        }

        return ((new UsuarioFactory())->fromDTO($userDTO));


    }

    /**
     * @param int $usuarioId
     * @return bool
     * @throws DataBaseException
     */
    public function remover(int $usuarioId): bool
    {
        try {
            $statementRemoverUsuario = $this->PDO->prepare("delete from usuario where id = :id");
            return $statementRemoverUsuario->execute([
                $usuarioId
            ]);

        } catch (\Exception $exception) {
            throw new DataBaseException($exception->getMessage());
        }
    }

    /**
     * @param UsuarioDTO $usuarioDTO
     * @param int $usuarioID
     * @return void
     * @throws DataBaseException
     */
    public function editar(UsuarioDTO $usuarioDTO, int $usuarioID): void
    {
        try {

            $sql = "update usuario set nome = :nome ,
                email = :email, 
                telefone = :telefone,
                updated_at = :updated_at,
                logradouro = :logradouro,
                numero =  :numero,
                cep = :cep,
                bairro = :bairro,
                perfil_id = :perfil_id,
                updated_at = :updatedAt
               where id = :id";

            $statementEditarUsuario = $this->PDO->prepare($sql);
            $usuarioSave = $statementEditarUsuario->execute([
                $usuarioDTO->nome, $usuarioDTO->email->getValor(), $usuarioDTO?->telefone->getValor(), date('Y-m-d H:m:i'),
                $usuarioDTO?->endereco->logradouro, $usuarioDTO?->endereco->numero, $usuarioDTO?->endereco->cep, $usuarioDTO?->endereco->bairro,
                $usuarioDTO->profile,
                date('Y-m-d H:m:i'),
                $usuarioID
            ]);

            if (!$usuarioSave) {
                throw new DataBaseException("Não foi possível editar o usuário");
            }

            //return $this->usuarioFactory->fromDTO($usuarioDTO);

        } catch (\Exception $exception) {
            throw new DataBaseException($exception->getMessage());
        }
    }

    /**
     * @param int $usuarioID
     * @return Usuario
     * @throws DataBaseException
     */
    public function getUsuarioById(int $usuarioID): Usuario
    {
        $statementUsuario = $this->PDO->prepare("select * from usuario where id = ?");
        $statementUsuario->bindParam(1, $usuarioID);
        try {
            $statementUsuario->execute();
            $dado = $statementUsuario->fetch(PDO::FETCH_ASSOC);

            return (new UsuarioFactory())->fromArray($dado);
        } catch (\Exception $exception) {
            throw new DataBaseException("Não foi possível resgatar o usuário.");
        }

    }
}