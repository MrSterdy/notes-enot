<?php

namespace NotesEnot\Core\db;

use mysqli;
use NotesEnot\Core\utils\Singleton;
use RuntimeException;

class Database
{
    use Singleton;

    private ?mysqli $connection;

    public function connect(): void
    {
        $connectResult = mysqli_connect(getenv("MYSQL_HOST"), getenv("MYSQL_USERNAME"), getenv("MYSQL_PASSWORD"), getenv("MYSQL_DATABASE"), intval(getenv("MYSQL_PORT")));
        if (!$connectResult) {
            throw new RuntimeException("Не удалось подключиться к базе данных");
        }

        $this->connection = $connectResult;
    }

    public function getConnection(): ?mysqli
    {
        return $this->connection;
    }
}