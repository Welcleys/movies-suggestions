<?php require_once __DIR__ . "/../../view/header.php"; ?>

<h1>Editar Categoria</h1>
<form method="POST" action="<?= BASE_URL ?>categorias/editar/<?= $categoria['id'] ?>">
    <input type="hidden" name="id" value="<?= $categoria['id'] ?>">
    <label>Nome da Categoria:</label>
    <input type="text" name="nome" value="<?= htmlspecialchars($categoria['nome']) ?>" required>
    <br><br>
    <button type="submit">Salvar</button>
</form>

<?php require_once __DIR__ . "/../../view/footer.php"; ?>