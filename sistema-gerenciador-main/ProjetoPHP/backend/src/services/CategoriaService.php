<?php
namespace App\Services;

use Exception;
use App\Models\Categoria;

class CategoriaService
{
    private $categoria;

    public function __construct()
    {
        $this->categoria = new Categoria();
    }
    
    public function createCategoria($data) {

        if (empty($data['nome_cat'])) {
            echo $data['nome_cat'];
            throw new Exception("O campo 'name' é obrigatório");
        }

        $result = $this->categoria->create($data);
        return $result;
    }

    public function getAllCategorias() {
        $categorias = $this->categoria->getAll();
        return $categorias;
    }

    public function getCategoria($id) {
        $categoria = $this->categoria->find($id);
        return $categoria;
    }

    public function updateCategoria($id, $data) {
        $result = $this->categoria->update($id, $data);
        return $result;
    }

    public function deleteCategoria($id) {
        $result = $this->categoria->delete($id);
        return $result;
    }
}