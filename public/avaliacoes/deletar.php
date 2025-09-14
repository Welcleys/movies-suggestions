<?php

require_once __DIR__ . "/../../controller/AvaliacoesController.php";

$controller = new AvaliacaoController();

if (isset($_GET['id'])) {
    $controller->deletar($_GET['id']);
}

header("Location: " . BASE_URL . "avaliacoes/listar");
exit;