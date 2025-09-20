<h2><?= isset($parametro) && $parametro->getId() ? "Editar Avaliação" : "Cadastrar Avaliação" ?></h2>

<form method="post" action="/movies-suggestions/avaliacao/<?= isset($parametro) && $parametro->getId() ? "atualizar" : "salvar" ?>">

    <?php if (isset($parametro) && $parametro->getId()): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($parametro->getId()) ?>">
    <?php endif; ?>

    <label for="filme_id">Filme:</label><br>
    <select id="filme_id" name="filme_id" required>
        <option value="">-- Selecione --</option>
        <?php foreach ($filmes as $filme): ?>
            <option value="<?= $filme->getId() ?>"
                <?= isset($parametro) && $parametro->getFilmeId() == $filme->getId() ? "selected" : "" ?>>
                <?= htmlspecialchars($filme->getNome()) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="nota">Nota:</label><br>
    <input type="number" id="nota" name="nota" min="0" max="10" step="0.1"
           value="<?= isset($parametro) ? htmlspecialchars($parametro->getNota()) : "" ?>" required><br><br>

    <button type="submit">Salvar</button>
    <a href="/movies-suggestions/avaliacao/listar">Cancelar</a>
</form>