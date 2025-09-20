<?php $isEditing = isset($filme) && $filme->getId(); ?>

<h1><?= $isEditing ? "Editar Filme" : "Adicionar Novo Filme" ?></h1>

<form action="<?= url("filme/salvar") ?>" method="POST">

    <?php if ($isEditing): ?>
        <input type="hidden" name="id" value="<?= $filme->getId() ?>">
    <?php endif; ?>

    <label>Título:</label><br>
    <input type="text" name="titulo" required value="<?= $isEditing ? htmlspecialchars($filme->getTitulo()) : "" ?>"><br><br>

    <label>Ano de Lançamento:</label><br>
    <input type="number" name="ano_lancamento" value="<?= $isEditing ? htmlspecialchars($filme->getAnoLancamento()) : "" ?>"><br><br>

    <button type="submit">Salvar</button>
</form>