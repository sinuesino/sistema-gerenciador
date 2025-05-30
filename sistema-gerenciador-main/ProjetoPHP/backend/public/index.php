<?php
require_once __DIR__ . '/../vendor/autoload.php';

$url = isset($_GET['url']) ? $_GET['url'] : '';
$partes = explode('/', $url);

$controllerName = !empty($partes[0]) ? ucfirst($partes[0]) . 'Controller' : 'HomeController';
$method = isset($partes[1]) ? $partes[1] : 'index';
$params = array_slice($partes, 2);

$controllerClass = 'App\\Controllers\\' . $controllerName;

if (class_exists($controllerClass)) {
    $instancia = new $controllerClass();
    if (method_exists($instancia, $method)) {
        $response = call_user_func_array([$instancia, $method], $params);
        echo $response;
    } else {
        echo "Método '$method' não encontrado no controller $controllerClass.";
    }
} else {
    echo "Controller $controllerClass não encontrado.";
}
