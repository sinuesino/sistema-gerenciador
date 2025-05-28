<?php
namespace App\Controllers;

use App\Services\CategoriaService;
use Exception;

class CategoriaController 
{
    private $categoria;

    public function __construct() {
        $this->categoria = new CategoriaService();
    }

    public function store() {

        $jsonInput = file_get_contents('php://input');
        if (empty($jsonInput)) {
            throw new Exception("O corpo da requisição está vazio");
        }

        $data = json_decode($jsonInput, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("JSON inválido. Erro: " . json_last_error_msg());
        }

        if (!isset($data['nome_cat'])) {
            throw new Exception("O campo 'nome' é obrigatório");
        }

        
        $result = $this->categoria->createCategoria($data);
        if ($result) {
            return json_encode(['status' => 'success', 'message' => 'Categoria criada com sucesso']);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Erro ao criar categoria']);
        }
    }

    public function index() {
        $result = $this->categoria->getAllCategorias();
        if ($result) {
            return json_encode(['status' => 'success', 'data' => $result->fetchAll()]);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Nenhuma categoria encontrada']);
        }
    }

    public function show($id) {
        $result = $this->categoria->getCategoria($id);
        if ($result) {
            return json_encode(['status' => 'success', 'data' => $result]);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Categoria não encontrada']);
        }
    }

    public function destroy($id) {
        $result = $this->categoria->deleteCategoria($id);
        if ($result) {
            return json_encode(['status' => 'success', 'message' => 'Categoria excluída com sucesso']);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Erro ao excluir categoria']);
        }
    }
}