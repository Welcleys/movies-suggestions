<?php

require_once __DIR__ . "/../../controller/CategoriaController.php";

$controller = new CategoriaController();

if (isset($_GET['id'])) {
    $controller->deletar($_GET['id']);
}

header("Location: " . BASE_URL . "categorias/listar");
exit;