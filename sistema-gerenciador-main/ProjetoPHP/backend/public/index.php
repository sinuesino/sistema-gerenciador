<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Controllers\CategoriaController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

echo $uri;

if ($method === 'POST') {
    (new CategoriaController())->store();
}

