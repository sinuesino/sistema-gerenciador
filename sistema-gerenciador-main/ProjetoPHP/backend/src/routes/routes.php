<?php

use App\Controllers\ProdutoController;
use App\Controllers\CategoriaController;

// Captura a URL da query string (?url=xxx)
$url = $_GET['url'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];

// Produtos
if ($url === 'produtos' && $method === 'GET') {
    echo (new ProdutoController())->index();
} elseif (preg_match('#^produtos/(\d+)$#', $url, $matches) && $method === 'GET') {
    echo (new ProdutoController())->show($matches[1]);
} elseif ($url === 'produtos' && $method === 'POST') {
    echo (new ProdutoController())->store();
} elseif (preg_match('#^produtos/(\d+)$#', $url, $matches) && $method === 'DELETE') {
    echo (new ProdutoController())->destroy($matches[1]);
}

// Categorias
elseif ($url === 'categorias' && $method === 'GET') {
    echo (new CategoriaController())->index();
} elseif ($url === 'categorias' && $method === 'POST') {
    echo (new CategoriaController())->store();
} elseif (preg_match('#^categorias/(\d+)$#', $url, $matches) && $method === 'GET') {
    echo (new CategoriaController())->show($matches[1]);
} elseif (preg_match('#^categorias/(\d+)$#', $url, $matches) && $method === 'DELETE') {
    echo (new CategoriaController())->destroy($matches[1]);
}

else {
    http_response_code(404);
    echo json_encode(['status' => 'error', 'message' => 'Rota não encontrada']);
}
