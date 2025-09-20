<a href="/movies-suggestions/categoria/formulario">Cadastrar Nova Categoria</a>

<table border="2" cellspacing="0" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Ações</th>
    </tr>

    <?php if (!empty($parametro)): ?>
        <?php foreach ($parametro as $c): ?>
            <tr>
                <td><?= htmlspecialchars($c->getId()) ?></td>
                <td><?= htmlspecialchars($c->getNome()) ?></td>
                <td>
                    <a href="/movies-suggestions/categoria/formulario?id=<?= $c->getId() ?>">Editar</a> | 
                    <a href="/movies-suggestions/categoria/excluir?id=<?= $c->getId() ?>" onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="3">Nenhuma categoria encontrada.</td></tr>
    <?php endif; ?>
</table>