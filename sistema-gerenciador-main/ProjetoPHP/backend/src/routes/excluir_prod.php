<?php
require_once __DIR__ . '/../controllers/produto_controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_prod']) && is_numeric($_POST['id_prod'])) {
        $id = $_POST['id_prod'];

        if (produto_controller::excluir($id)) {
            echo "Produto excluído com sucesso!";
        } else {
            echo "Erro ao excluir produto.";
        }
    } else {
        echo "ID inválido.";
    }
} else {
    echo "Requisição inválida.";
}