<?php

class Database
{
    private $host = "database";
    private $db_name = "appDB2";
    private $username = "user";
    private $password = "password";
    public $conn;

    public function getConnection(): ?PDO
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Ошибка подключения: " . $exception->getMessage();
        }

        return $this->conn;
    }
}