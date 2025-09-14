<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/autoload.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$route = str_replace(BASE_URL, '', $uri);

$parts = explode('/', trim($route, '/'));

$controller = $parts[0] ?? 'filmes';
$action     = $parts[1] ?? 'listar';

$file = __DIR__ . "/public/{$controller}/{$action}.php";

if (file_exists($file)) {
    require $file;
} else {
    http_response_code(404);
    require __DIR__ . "/view/header.php";
    echo "<h1>Página em costrução!</h1>";
    require __DIR__ . "/view/footer.php";
}
