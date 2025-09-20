<?php 
    session_start(); 
    if (isset($_SESSION["mensagem"])): 
?>
    <div style="padding: 15px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px; margin-bottom: 10px;">
        <?= $_SESSION['mensagem'] ?>
    </div>
<?php 
    // Limpa a mensagem para que não apareça de novo
    unset($_SESSION["mensagem"]); 
    endif; 
?>
<h1>Lista de Categorias</h1>
<a href="index.php?param=categoria/form">Adicionar Nova Categoria</a>
<hr>
<table border="1" width="100%">
    <tbody>
        <?php foreach ($listaDeCategorias as $categoria): ?>
            <tr>
                <td><?= $categoria->getId() ?></td>
                <td><?= htmlspecialchars($categoria->getNome()) ?></td>
                <td>
                    <a href="<?= url("categoria/form/" . $categoria->getId()) ?>">Editar</a>
                    <a href="<?= url("categoria/excluir/" . $categoria->getId()) ?>" onclick="return confirm('Tem certeza?');">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br>
<br>
<a href="<?= url() ?>">Voltar para a Página Inicial</a>