<a href="/movies-suggestions/filme/formulario">Cadastrar</a>
<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Endereco</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($parametro as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p["id"]) ?></td>
            <td><?= htmlspecialchars($p["nome"]) ?></td>
            <td><?= htmlspecialchars($p["endereco"]) ?></td>
            <td>
                <a href="/movies-suggestions/filme/formularioalterar?id=<?= $p["id"] ?>">Alterar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>