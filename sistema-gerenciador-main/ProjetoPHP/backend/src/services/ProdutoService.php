<?php
namespace App\Services;

use Exception;
use App\Models\Produto;

class ProdutoService
{
    private $produto;

    public function __construct()
    {
        $this->produto = new Produto();
    }

    public function createProduto($data)
    {
        // Validação básica
        if (empty($data['nome_prod'])) {
            throw new Exception("O campo 'nome_prod' é obrigatório.");
        }

        if (!isset($data['cat_prod']) || !is_numeric($data['cat_prod'])) {
            throw new Exception("O campo 'cat_prod' é obrigatório e deve ser numérico.");
        }

        if (!isset($data['valor_prod']) || !is_numeric($data['valor_prod'])) {
            throw new Exception("O campo 'valor_prod' é obrigatório e deve ser numérico.");
        }

        if (!isset($data['estoque_prod']) || !is_numeric($data['estoque_prod'])) {
            throw new Exception("O campo 'estoque_prod' é obrigatório e deve ser numérico.");
        }

        if (!isset($data['cod_prod']) || !is_numeric($data['cod_prod'])) {
            throw new Exception("O campo 'cod_prod' é obrigatório e deve ser numérico.");
        }

        if (!isset($data['situacao_prod']) || !is_numeric($data['situacao_prod'])) {
            throw new Exception("O campo 'situacao_prod' é obrigatório e deve ser numérico.");
        }

        return $this->produto->create($data);
    }

    public function getAllProdutos()
    {
        return $this->produto->getAll();
    }

    public function getProduto($id)
    {
        return $this->produto->find($id);
    }

    public function deleteProduto($id)
    {
        return $this->produto->delete($id);
    }

    public function updateProduto($id, $data)
    {
        // Certifique-se de implementar o método update no Model
        return $this->produto->update($id, $data);
    }
}
