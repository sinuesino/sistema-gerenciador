<?php
require_once __DIR__ . '/../db/conn.php';

class produto_controller {
    public static function excluir($id) {
        global $conn;
        $sql = "DELETE FROM produto WHERE id_prod = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
