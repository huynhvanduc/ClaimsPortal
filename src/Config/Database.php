<?php
namespace ClaimPortal\Config;

class Database {
    private $host = 'localhost';
    private $dbname = 'claim_portal';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function getConnection() {
        try {
            $this->conn = new \PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (\PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}