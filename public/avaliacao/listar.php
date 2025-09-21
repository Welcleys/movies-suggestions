<?php 
    session_start(); 
    if (isset($_SESSION["mensagem"])): 
?>
    <div style="padding: 15px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px; margin-bottom: 10px;">
        <?= $_SESSION["mensagem"] ?>
    </div>
<?php 
    unset($_SESSION["mensagem"]); 
    endif; 
?>
<h1>Lista de Avaliações</h1>
<a href="<?= url("avaliacao/form") ?>">Adicionar Nova Avaliação</a>
<hr>
<table border="1" width="100%">
    <thead>
        <tr>
            <th>Filme</th>
            <th>Categoria</th>
            <th>Nota</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listaDeAvaliacoes as $avaliacao): ?>
            <tr>
                <td><?= htmlspecialchars($avaliacao->getFilmeTitulo()) ?></td>
                <td><?= htmlspecialchars($avaliacao->getCategoriaNome()) ?></td>
                <td><?= $avaliacao->getNota() ?></td>
                <td>
                    <a href="<?= url("avaliacao/form/" .  $avaliacao->getId()) ?>">Editar</a>
                    <a href="<?= url("avaliacao/excluir/" . $avaliacao->getId()) ?>" onclick="return confirm('Tem certeza?');">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br>
<br>
<a href="<?= url() ?>">Voltar para a Página Inicial</a>