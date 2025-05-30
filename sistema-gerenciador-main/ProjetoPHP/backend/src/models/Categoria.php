<?php 
namespace App\Models;

use PDO;
use App\Db\Database;
require_once __DIR__ . '/../db/conn.php';

class Produto
{
    private $conn;
    private $db;
    private $table = 'produto';

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
        $statement = $this->conn->prepare("SELECT * FROM $this->table WHERE id_prod = :id");
        $statement->bindParam(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO $this->table (nome_prod, cat_prod, valor_prod, estoque_prod, cod_prod, situacao_prod) 
                  VALUES (:nome_prod, :cat_prod, :valor_prod, :estoque_prod, :cod_prod, :situacao_prod)";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':nome_prod', $data['nome_prod']);
        $statement->bindParam(':cat_prod', $data['cat_prod']);
        $statement->bindParam(':valor_prod', $data['valor_prod']);
        $statement->bindParam(':estoque_prod', $data['estoque_prod']);
        $statement->bindParam(':cod_prod', $data['cod_prod']);
        $statement->bindParam(':situacao_prod', $data['situacao_prod']);
        return $statement->execute();
    }

    public function delete($id) {
        $statement = $this->conn->prepare("DELETE FROM $this->table WHERE id_prod = :id");
        $statement->bindParam(':id', $id);
        return $statement->execute();
    }
}
