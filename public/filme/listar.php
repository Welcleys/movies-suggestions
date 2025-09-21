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
<h1>Lista de Filmes</h1>
<a href="<?= url("filme/form") ?>">Adicionar Novo Filme</a>
<hr>
<table border="1" width="100%">
    <tbody>
        <?php foreach ($listaDeFilmes as $filme): ?>
            <tr>
                <td><?= $filme->getId() ?></td>
                <td><?= htmlspecialchars($filme->getTitulo()) ?></td>
                <td><?= $filme->getAnoLancamento() ?></td>
                <td>
                    <a href="<?= url("filme/form/" . $filme->getId()) ?>">Editar</a>
                    <a href="<?= url("filme/excluir/" . $filme->getId()) ?>" onclick="return confirm('Tem certeza?');">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br>
<br>
<a href="<?= url() ?>">Ir para a Página Inicial</a>