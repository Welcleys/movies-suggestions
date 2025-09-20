<h2><?= isset($parametro) && $parametro->getId() ? "Editar Categoria" : "Cadastrar Categoria" ?></h2>

<form method="post" action="/movies-suggestions/categoria/<?= isset($parametro) && $parametro->getId() ? "atualizar" : "salvar" ?>">

    <?php if (isset($parametro) && $parametro->getId()): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($parametro->getId()) ?>">
    <?php endif; ?>

    <label for="nome">Nome da Categoria:</label><br>
    <input type="text" id="nome" name="nome" 
           value="<?= isset($parametro) ? htmlspecialchars($parametro->getNome()) : "" ?>" required><br><br>

    <button type="submit">Salvar</button>
    <a href="/movies-suggestions/categoria/listar">Cancelar</a>
</form>