<?php

namespace App\Infra\Repositories;

use App\Application\Factories\UsuarioFactory;
use App\Domain\DTOs\UsuarioDTO;
use App\Domain\Entities\Usuario;
use App\Domain\Exceptions\DataBaseException;
use App\Domain\Exceptions\InvalidValueException;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Infra\Adapters\UsuarioPDOAdapter;
use PDO;

class UsuarioPDORepository implements UsuarioRepositoryInterface
{
    public function __construct(private readonly PDO $PDO)
    {
    }

    /**
     * @param Usuario $user
     * @return Usuario
     * @throws DataBaseException
     * @throws InvalidValueException
     */
    public function adicionar(Usuario $user): Usuario
    {

        $statementAdicionarUsuario = $this->PDO->prepare("insert into usuario (
                     nome, email, telefone, created_at, updated_at, logradouro, numero, cep, bairro, perfil_id) 
                values (:nome, :email,:telefone,:created_at,:updated_at, :logradouro,:numero,:cep,:bairro,:perfil_id)
                returning id,nome,email,telefone,logradouro,numero,cep,bairro, perfil_id
            ");

        $usuarioAdicionado = $statementAdicionarUsuario->execute(
            [
                $user->nome,
                $user->email->getValor(),
                $user->telefone->getValor(),
                date('Y-m-d H:m:i'),
                date('Y-m-d H:m:i'),
                $user->endereco->logradouro,
                $user->endereco->numero,
                $user->endereco->cep,
                $user->endereco->bairro,
                '1'
            ]
        );

        if (!$usuarioAdicionado) {
            throw new DataBaseException("Não foi possível adicionar o usuário");
        }

        $userSaved = $statementAdicionarUsuario->fetch();

        return ((new UsuarioFactory())->fromArray($userSaved));


    }

    /**
     * @param int $usuarioId
     * @return bool
     * @throws DataBaseException
     */
    public function remover(int $usuarioId): bool
    {
        try {
            $statementRemoverUsuario = $this->PDO->prepare("delete from usuario where id = :id returning *");
            $statementRemoverUsuario->execute([$usuarioId]);

        } catch (\Exception $exception) {
            throw new DataBaseException($exception->getMessage());
        }

        $rowsDeleted = $statementRemoverUsuario->fetch(PDO::FETCH_ASSOC);

        return !empty($rowsDeleted);
    }

    /**
     * @param array $paramnsUsuario
     * @param int $usuarioID
     * @return Usuario|false
     * @throws DataBaseException
     * @throws InvalidValueException
     */
    public function editar(array $paramnsUsuario, int $usuarioID): Usuario|false
    {
        try {

            $valoresBind = [];

//            $sql = "update usuario set nome = :nome ,
//                email = :email,
//                telefone = :telefone,
//                updated_at = :updated_at,
//                logradouro = :logradouro,
//                numero =  :numero,
//                cep = :cep,
//                bairro = :bairro,
//                perfil_id = :perfil_id,
//                updated_at = :updatedAt
//               where id = :id
//            returning *";

            $sql = "update usuario set ";

            foreach ($paramnsUsuario as $atributoUsuarioNome => $atributoUsuarioValor) {
                $sql .= " {$atributoUsuarioNome} = :{$atributoUsuarioNome},";
                $valoresBind[] = $atributoUsuarioValor;
            }

            if (str_ends_with($sql, ',')) {
                $sql = substr($sql, 0, -1);
            }

            $sql .= " where id = :id returning *;";

            $statementEditarUsuario = $this->PDO->prepare($sql);
            $usuarioSave = $statementEditarUsuario->execute([
                ...$valoresBind,
                $usuarioID
            ]);



        } catch (\Exception $exception) {
            throw new DataBaseException($exception->getMessage());
        }

        $usuarioAtualizado = $statementEditarUsuario->fetch(PDO::FETCH_ASSOC);

        if ($usuarioAtualizado === false){
            return false;
        }

        return ((new UsuarioFactory())->fromArray($usuarioAtualizado));

        //return $this->usuarioFactory->fromDTO($usuarioDTO);
    }

    /**
     * @param int $usuarioID
     * @return Usuario|bool
     * @throws DataBaseException
     * @throws InvalidValueException
     */
    public function getUsuarioById(int $usuarioID): Usuario|bool
    {
        $statementUsuario = $this->PDO->prepare("select * from usuario where id = ?");
        $statementUsuario->bindParam(1, $usuarioID);

        try {
            $statementUsuario->execute();
        } catch (\Exception $exception) {
            throw new DataBaseException("Não foi possível resgatar o usuário.");
        }

        $dado = $statementUsuario->fetch(PDO::FETCH_ASSOC);

        if (!$dado) {
            return false;
        }

        return (new UsuarioFactory())->fromArray($dado);

    }
}