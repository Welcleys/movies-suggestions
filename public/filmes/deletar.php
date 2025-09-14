<?php

require_once __DIR__ . "/../../controller/FilmeController.php";

$controller = new FilmeController();

if (isset($_GET['id'])) {
    $controller->deletar($_GET['id']);
}

header("Location: " . BASE_URL . "filmes/listar");
exit;