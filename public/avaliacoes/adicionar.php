<?php
require_once __DIR__ . "/../../view/header.php";
?>

<h1>Adicionar Avaliação</h1>
<form method="POST">
    <label>Filme:</label>
    <select name="filme_id" required>
        <option value="">Selecione</option>
        <?php foreach ($filmes as $filme): ?>
            <option value="<?= $filme['id'] ?>"><?= htmlspecialchars($filme['titulo']) ?></option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <label>Categoria:</label>
    <select name="categoria_id" required>
        <option value="">Selecione</option>
        <?php foreach ($categorias as $categoria): ?>
            <option value="<?= $categoria['id'] ?>"><?= htmlspecialchars($categoria['nome']) ?></option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <label>Nota (1 a 10):</label>
    <input type="number" name="nota" min="1" max="10" required>
    <br><br>

    <button type="submit">Salvar</button>
</form>

<?php require_once __DIR__ . "/../../view/footer.php"; ?>