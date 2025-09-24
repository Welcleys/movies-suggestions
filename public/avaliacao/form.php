<?php $isEditing = isset($avaliacao) && $avaliacao->getId(); ?>
<h1><?= $isEditing ? 'Editar Avaliação' : 'Adicionar Nova Avaliação' ?></h1>

<form id="avaliacao_form" action="<?= url("avaliacao/salvar") ?>" method="POST">
    
    <?php if($isEditing): ?>
        <input type="hidden" name="id" value="<?= $avaliacao->getId() ?>">
    <?php endif; ?>

    <label>Filme:</label><br>
    <select name="filme_id" id="filme_select" required>
        <option value="">Selecione um filme...</option>
        <?php foreach ($listaDeFilmes as $filme): ?>
            <option value="<?= $filme->getId() ?>" <?= ($isEditing && $filme->getId() == $avaliacao->getFilmeId()) ? "selected" : "" ?>>
                <?= htmlspecialchars($filme->getTitulo()) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Categoria:</label><br>
    <select name="categoria_id" id="categoria_select" required>
        <option value="">Selecione uma categoria...</option>
        <?php foreach ($listaDeCategorias as $categoria): ?>
            <option value="<?= $categoria->getId() ?>" <?= ($isEditing && $categoria->getId() == $avaliacao->getCategoriaId()) ? "selected" : "" ?>>
                <?= htmlspecialchars($categoria->getNome()) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>
    
    <label>Nota (1 a 10):</label><br>
    <input type="number" name="nota" min="1" max="10" required value="<?= $isEditing ? $avaliacao->getNota() : "" ?>"><br><br>
    
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="<?= url("avaliacao/listar") ?>" class="btn btn-secondary">Cancelar</a>
</form>

<script>

    const filmeSelect = document.getElementById("filme_select");
    const categoriaSelect = document.getElementById("categoria_select");
    const avaliacaoForm = document.getElementById("avaliacao_form");
    const urlEndpoint = '<?= url("avaliacao/get-categoria-do-filme") ?>';

    avaliacaoForm.addEventListener("submit", function() {
        categoriaSelect.disabled = false;
    });

    async function verificarCategoriaDoFilme() {
        const filmeId = filmeSelect.value;

        if (!filmeId) {
            categoriaSelect.disabled = false;
            return;
        }

        const response = await fetch(`${urlEndpoint}?filme_id=${filmeId}`);
        const data = await response.json();

        if (data.categoria_id) {
            categoriaSelect.value = data.categoria_id;
            categoriaSelect.disabled = true;
        } else {
            categoriaSelect.disabled = false;
        }
    }

    filmeSelect.addEventListener("change", verificarCategoriaDoFilme);

    document.addEventListener("DOMContentLoaded", verificarCategoriaDoFilme);
</script>