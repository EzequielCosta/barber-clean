<?php

namespace App\Infra\Connections;

use App\Domain\Exceptions\DataBaseException;
use App\Domain\Exceptions\PDOConnectionException;
use PDO;

//require_once __DIR__ . '../../../configs/database.php';

class PDOConnection
{
    private array $dataBaseConfig;

    /**
     * @throws PDOConnectionException
     */
    public function __construct()
    {
        $this->dataBaseConfig = require_once __DIR__ . '/../../../configs/database.php';
    }

    /**
     * @param string $driveName
     * @return PDO
     * @throws PDOConnectionException
     */
    public function connect(string $driveName): PDO
    {
        try {
            $driveConfig = $this->dataBaseConfig["drives"][$driveName];

            return new PDO(
                "pgsql:host={$driveConfig["host"]};port={$driveConfig["port"]};dbname={$driveConfig["database"]}",
                username: $driveConfig["username"],
                password: $driveConfig["password"],

            );
        } catch (\Exception $exception) {
            throw new PDOConnectionException("Não foi possível conectar ao banco de dados");
        }
    }
}