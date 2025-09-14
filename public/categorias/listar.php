<?php

require_once __DIR__ . "/../../view/header.php";
?>

<h1>Lista de Categorias</h1>
<a href="<?= BASE_URL ?>categorias/adicionar">Adicionar Categoria</a>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($categorias as $categoria): ?>
    <tr>
        <td><?= $categoria['id'] ?></td>
        <td><?= htmlspecialchars($categoria['nome']) ?></td>
        <td>
            <a href="<?= BASE_URL ?>categorias/editar/<?= $categoria['id'] ?>">Editar</a>
            <a href="<?= BASE_URL ?>categorias/deletar/<?= $categoria['id'] ?>" onclick="return confirm('Deseja excluir esta categoria?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php require_once __DIR__ . "/../../view/footer.php"; ?>