<h2><?= isset($parametro) && $parametro->getId() ? "Editar Filme" : "Cadastrar Filme" ?></h2>

<form method="post" action="/movies-suggestions/filme/<?= isset($parametro) && $parametro->getId() ? "atualizar" : "salvar" ?>">

    <?php if (isset($parametro) && $parametro->getId()): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($parametro->getId()) ?>">
    <?php endif; ?>

    <label for="nome">Nome:</label><br>
    <input type="text" id="nome" name="nome"
        value="<?= isset($parametro) ? htmlspecialchars($parametro->getNome()) : "" ?>" required><br><br>

    <label for="ano_lancamento">Ano de Lançamento:</label><br>
    <input type="text" id="ano_lancamento" name="ano_lancamento"
        value="<?= isset($parametro) ? htmlspecialchars($parametro->getAnoLancamento()) : "" ?>" required><br><br>

    <label for="categoria_id">Categoria:</label><br>
    <select id="categoria_id" name="categoria_id" required>
        <option value="">-- Selecione --</option>
        <?php foreach ($categorias as $categoria): ?>
            <option value="<?= $categoria->getId() ?>"
                <?= isset($parametro) && $parametro->getCategoriaId() == $categoria->getId() ? "selected" : "" ?>>
                <?= htmlspecialchars($categoria->getNome()) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Salvar</button>
    <a href="/movies-suggestions/filme/listar">Cancelar</a>
</form>