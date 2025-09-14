<?php require_once __DIR__ . "/../../view/header.php"; ?>

<h1>Adicionar Categoria</h1>
<form method="POST" action="<?= BASE_URL ?>categorias/adicionar">
    <label>Nome da Categoria:</label>
    <input type="text" name="nome" required>
    <br><br>
    <button type="submit">Salvar</button>
</form>

<?php require_once __DIR__ . "/../../view/footer.php"; ?>