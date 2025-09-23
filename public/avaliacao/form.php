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
    // Pega os elementos do formulário
    const filmeSelect = document.getElementById("filme_select");
    const categoriaSelect = document.getElementById("categoria_select");
    const avaliacaoForm = document.getElementById("avaliacao_form");
    
    // --- MUDANÇA 1: Criamos a variável com a URL base aqui ---
    // O PHP gera a URL uma única vez e a armazena em uma variável JavaScript limpa.
    const urlEndpoint = '<?= url("avaliacao/get-categoria-do-filme") ?>';

    // Adiciona um "ouvinte" para o evento de SUBMISSÃO do formulário
    avaliacaoForm.addEventListener("submit", function() {
        // Um milissegundo antes de enviar, reabilita o campo de categoria
        // para que seu valor seja incluído nos dados do POST.
        categoriaSelect.disabled = false;
    });

    // Função que faz a verificação
    async function verificarCategoriaDoFilme() {
        const filmeId = filmeSelect.value;

        if (!filmeId) {
            categoriaSelect.disabled = false; // Habilita se nenhum filme for selecionado
            return;
        }

        // --- MUDANÇA 2: Usamos a variável e as crases (`) corretamente ---
        // A chamada fetch agora usa a variável limpa que criamos.
        // Note o uso de crases (` `) em vez de aspas (" ") para permitir o ${filmeId}.
        const response = await fetch(`${urlEndpoint}?filme_id=${filmeId}`);
        
        const data = await response.json();

        if (data.categoria_id) {
            // Se uma categoria foi retornada, seleciona e desabilita o campo
            categoriaSelect.value = data.categoria_id;
            categoriaSelect.disabled = true;
        } else {
            // Se não, habilita o campo para o usuário escolher
            categoriaSelect.disabled = false;
        }
    }

    // Adiciona o "ouvinte de evento": toda vez que o usuário MUDAR o filme, a função será chamada
    filmeSelect.addEventListener("change", verificarCategoriaDoFilme);

    // Executa a função uma vez quando a página carrega, para o caso de edição
    document.addEventListener("DOMContentLoaded", verificarCategoriaDoFilme);
</script>