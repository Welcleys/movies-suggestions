<?php

require_once __DIR__ . "/../../view/header.php";
require_once __DIR__ . "/../../controller/FilmeController.php";

$controller = new FilmeController();

$id = $_GET['id'];
$filme = $controller->buscarPorId($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $controller->atualizar($_POST['id'], $_POST['titulo'], $_POST['ano_lancamento'], $_POST['tempo_duracao']);
    
    header("Location: " . BASE_URL . "filmes/listar");
    exit;
}
?>

<h1>Editar Filme</h1>
<form method="POST">
    <input type="hidden" name="id" value="<?= $filme['id'] ?>">

    <label>Título:</label>
    <input type="text" name="titulo" value="<?= htmlspecialchars($filme['titulo']) ?>" required>
    <br><br>

    <label>Ano de Lançamento:</label>
    <input type="number" name="ano_lancamento" value="<?= $filme['ano_lancamento'] ?>" required>
    <br><br>

    <label>Tempo de Duração (minutos):</label>
    <input type="number" name="tempo_duracao" value="<?= $filme['tempo_duracao'] ?>" required>
    <br><br>

    <button type="submit">Salvar</button>
</form>

<?php require_once __DIR__ . "/../../view/footer.php"; ?>