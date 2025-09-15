<?php

require_once __DIR__ . "/../../view/header.php";

$controller = new FilmeController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    $controller->adicionar($_POST['titulo'], $_POST['ano_lancamento'], $_POST['tempo_duracao']);
    
    header("Location: " . BASE_URL . "filmes/listar");
    exit;
}
?>

<h1>Adicionar Filme</h1>
<form method="POST">
    <label>Título:</label>
    <input type="text" name="titulo" required>
    <br><br>

    <label>Ano de Lançamento:</label>
    <input type="number" name="ano_lancamento" required>
    <br><br>

    <label>Tempo de Duração (minutos):</label>
    <input type="number" name="tempo_duracao" required>
    <br><br>

    <button type="submit">Salvar</button>
</form>

<?php require_once __DIR__ . "/../../view/footer.php"; ?>