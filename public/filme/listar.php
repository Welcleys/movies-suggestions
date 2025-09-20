<h1>Lista de Filmes</h1>
<a href="index.php?param=filme/form">Adicionar Novo Filme</a>
<hr>
<table border="1" width="100%">
    <tbody>
        <?php foreach ($listaDeFilmes as $filme): ?>
            <tr>
                <td><?= $filme->getId() ?></td>
                <td><?= htmlspecialchars($filme->getTitulo()) ?></td>
                <td><?= $filme->getAnoLancamento() ?></td>
                <td>
                    <a href="index.php?param=filme/form/<?= $filme->getId() ?>">Editar</a>
                    <a href="index.php?param=filme/excluir/<?= $filme->getId() ?>" onclick="return confirm('Tem certeza?');">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>