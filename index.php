<?php

require_once __DIR__ . '/generic/config.php';
require_once __DIR__ . '/generic/autoload.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = str_replace(BASE_URL, '', $uri);
$parts = explode('/', trim($route, '/'));

$controllerMap = [
    'filmes' => 'FilmeController',
    'categorias' => 'CategoriaController',
    'avaliacoes' => 'AvaliacaoController',
];

$routeController = $parts[0] ?? 'filmes';
$controllerName = $controllerMap[$routeController] ?? null;
$actionName = $parts[1] ?? 'index';

if ($controllerName === null) {
    http_response_code(404);
    require __DIR__ . "/view/header.php";
    echo "<h1>Aplicação em construção!</h1>";
    require __DIR__ . "/view/footer.php";
    return;
}

if (!class_exists($controllerName)) {
    http_response_code(404);
    require __DIR__ . "/view/header.php";
    echo "<h1>Erro 404: Controller não encontrado!</h1>";
    require __DIR__ . "/view/footer.php";
    return;
}

$controller = new $controllerName();

if (!method_exists($controller, $actionName)) {
    http_response_code(404);
    require __DIR__ . "/view/header.php";
    echo "<h1>Erro 404: Ação não encontrada!</h1>";
    require __DIR__ . "/view/footer.php";
    return;
}

$controller->$actionName();