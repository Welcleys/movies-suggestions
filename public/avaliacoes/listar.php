<?php

require_once __DIR__ . "/../../view/header.php";
?>

<h1>Lista de Avaliações</h1>
<a href="<?= BASE_URL ?>avaliacoes/adicionar">Adicionar Avaliação</a>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Filme</th>
        <th>Categoria</th>
        <th>Nota</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($avaliacoes as $avaliacao): ?>
    <tr>
        <td><?= $avaliacao['id'] ?></td>
        <td><?= htmlspecialchars($avaliacao['filme']) ?></td>
        <td><?= htmlspecialchars($avaliacao['categoria']) ?></td>
        <td><?= $avaliacao['nota'] ?></td>
        <td>
            <a href="<?= BASE_URL ?>avaliacoes/editar?id=<?= $avaliacao['id'] ?>">Editar</a>
            <a href="<?= BASE_URL ?>avaliacoes/deletar?id=<?= $avaliacao['id'] ?>" onclick="return confirm('Deseja excluir esta avaliação?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php require_once __DIR__ . "/../../view/footer.php"; ?>