<a href="/movies-suggestions/avaliacao/formulario">Cadastrar Nova Avaliação</a>

<table border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Filme</th>
        <th>Nota</th>
        <th>Ações</th>
    </tr>

    <?php if (!empty($parametro)): ?>
        <?php foreach ($parametro as $a): ?>
            <tr>
                <td><?= htmlspecialchars($a->getId()) ?></td>
                <td><?= htmlspecialchars($a->getFilmeId()) ?></td>
                <td><?= htmlspecialchars($a->getNota()) ?></td>
                <td>
                    <a href="/movies-suggestions/avaliacao/formulario?id=<?= $a->getId() ?>">Editar</a> | 
                    <a href="/movies-suggestions/avaliacao/excluir?id=<?= $a->getId() ?>" onclick="return confirm('Tem certeza que deseja excluir esta avaliação?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="4">Nenhuma avaliação encontrada.</td></tr>
    <?php endif; ?>
</table>