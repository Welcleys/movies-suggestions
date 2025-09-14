<?php

require_once __DIR__ . "/../../view/header.php";
?>

<h1>Lista de Filmes</h1>
<a href="<?= BASE_URL ?>filmes/adicionar">Adicionar Filme</a>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Ano de Lançamento</th>
        <th>Duração (min)</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($filmes as $filme): ?>
    <tr>
        <td><?= $filme['id'] ?></td>
        <td><?= htmlspecialchars($filme['titulo']) ?></td>
        <td><?= $filme['ano_lancamento'] ?></td>
        <td><?= $filme['tempo_duracao'] ?></td>
        <td>
            <a href="<?= BASE_URL ?>filmes/editar?id=<?= $filme['id'] ?>">Editar</a>
            <a href="<?= BASE_URL ?>filmes/deletar?id=<?= $filme['id'] ?>" onclick="return confirm('Deseja excluir este filme?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php require_once __DIR__ . "/../../view/footer.php"; ?>