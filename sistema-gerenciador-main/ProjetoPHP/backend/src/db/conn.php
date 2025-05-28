<?php
namespace App\Db;

use PDO;

class Database{
    private $host = 'localhost';
    private $db_name = 'projeto_db';
    private $user = 'root';
    private $password = '';
    private $charset = 'utf8mb4';
    public $conn;

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=$this->host;dbname=$this->db_name;charset=$this->charset",
                $this->user,
                $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
            exit;
        }
    }
}