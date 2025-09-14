<?php

require_once __DIR__ . "/../../view/header.php";

$controller = new AvaliacaoController();
$filmeController = new FilmeController();
$categoriaController = new CategoriaController();

$filmes = $filmeController->index();
$categorias = $categoriaController->index();

$id = $_GET['id'];
$avaliacoes = $controller->index();
$avaliacao = array_filter($avaliacoes, fn($a) => $a['id'] == $id);
$avaliacao = reset($avaliacao);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->atualizar($_POST['id'], $_POST['filme_id'], $_POST['categoria_id'], $_POST['nota']);
    header("Location: " . BASE_URL . "avaliacoes/listar");
    exit;
}
?>

<h1>Editar Avaliação</h1>
<form method="POST">
    <input type="hidden" name="id" value="<?= $avaliacao['id'] ?>">

    <label>Filme:</label>
    <select name="filme_id" required>
        <?php foreach ($filmes as $filme): ?>
            <option value="<?= $filme['id'] ?>" <?= ($filme['titulo'] == $avaliacao['filme']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($filme['titulo']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <label>Categoria:</label>
    <select name="categoria_id" required>
        <?php foreach ($categorias as $categoria): ?>
            <option value="<?= $categoria['id'] ?>" <?= ($categoria['nome'] == $avaliacao['categoria']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($categoria['nome']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <label>Nota (1 a 10):</label>
    <input type="number" name="nota" min="1" max="10" value="<?= $avaliacao['nota'] ?>" required>
    <br><br>

    <button type="submit">Salvar</button>
</form>

<?php require_once __DIR__ . "/../../view/footer.php"; ?>