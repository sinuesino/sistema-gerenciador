<?php 
namespace App\Models;

use PDO;
use App\Db\Database;
require_once __DIR__ . '/../db/conn.php';

class Categoria
{
    private $conn;
    private $db;
    private $table = 'categoria';

    public function __construct() {
        $this->db = new Database();
        $this->db->connect();
        $this->conn = $this->db->conn;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $statement = $this->conn->prepare($query);
        $statement->execute();
        return $statement;
    }

    public function find($id) {
        $statement = $this->conn->prepare("SELECT * FROM $this->table WHERE id_cat = :id");
        $statement->bindParam(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO $this->table (nome_cat, situacao_cat) 
                  VALUES (:nome_cat, :situacao_cat)";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':nome_cat', $data['nome_cat']);
        $statement->bindParam(':situacao_cat', $data['situacao_cat']);
        return $statement->execute();
    }

    public function delete($id) {
        $statement = $this->conn->prepare("DELETE FROM $this->table WHERE id_cat = :id");
        $statement->bindParam(':id', $id);
        return $statement->execute();
    }
}
