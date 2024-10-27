<?php

namespace Database;

use PDO;
use PDOException;

class DatabaseConnection
{
    
    private PDO $conn;
    public function __construct(
        private string $host = 'localhost',
        private string $username = 'root',
        private string $password = '',
        private string $databaseName = 'todo-list'
    ) {
        $this->connection();
    }

    private function connection(): void
    {
        try {
            $this->conn = new PDO(
                "mysql:host=$this->host;dbname=$this->databaseName",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            echo "Connection failed: " . $error->getMessage();
        }
    }

    public function getConnection(): PDO
    {
        return $this->conn;
    }
}