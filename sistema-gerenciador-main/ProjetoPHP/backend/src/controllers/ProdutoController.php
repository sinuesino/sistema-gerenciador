<?php
namespace App\Controllers;

use App\Services\ProdutoService;
use Exception;

class ProdutoController
{
    private $produto;

    public function __construct() {
        $this->produto = new ProdutoService();
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

        $camposObrigatorios = ['nome_prod', 'cat_prod', 'valor_prod', 'estoque_prod', 'cod_prod', 'situacao_prod'];
        foreach ($camposObrigatorios as $campo) {
            if (!isset($data[$campo])) {
                throw new Exception("O campo '$campo' é obrigatório");
            }
        }

        $result = $this->produto->createProduto($data);
        if ($result) {
            return json_encode(['status' => 'success', 'message' => 'Produto criado com sucesso']);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Erro ao criar produto']);
        }
    }

    public function index() {
        $result = $this->produto->getAllProdutos();
        if ($result) {
            return json_encode(['status' => 'success', 'data' => $result->fetchAll()]);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Nenhum produto encontrado']);
        }
    }

    public function show($id) {
        $result = $this->produto->getProduto($id);
        if ($result) {
            return json_encode(['status' => 'success', 'data' => $result]);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Produto não encontrado']);
        }
    }

    public function destroy($id) {
        $result = $this->produto->deleteProduto($id);
        if ($result) {
            return json_encode(['status' => 'success', 'message' => 'Produto excluído com sucesso']);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Erro ao excluir produto']);
        }
    }
}
