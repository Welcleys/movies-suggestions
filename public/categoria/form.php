<?php 
$isEditing = isset($categoria) && $categoria->getId(); 
?>

<h1><?= $isEditing ? "Editar Categoria" : "Adicionar Nova Categoria" ?></h1>

<form action="<?=url("categoria/salvar") ?>" method="POST">

    <?php if ($isEditing): ?>
        <input type="hidden" name="id" value="<?= $categoria->getId() ?>">
    <?php endif; ?>

    <label>Nome:</label><br>
    <input type="text" name="nome" required value="<?= $isEditing ? htmlspecialchars($categoria->getNome()) : "" ?>"><br><br>

    <button type="submit">Salvar</button>
</form>