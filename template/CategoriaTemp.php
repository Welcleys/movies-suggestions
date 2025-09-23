<?php
namespace template;

class CategoriaTemp implements ITemplate
{
    /**
     * Gera o cabeçalho completo da página.
     */
    public function cabecalho()
    {
        $caminhoBase = "/movies-suggestions";

        echo <<<HTML
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Categorias</title>

    <link rel="stylesheet" href="{$caminhoBase}/public/css/estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        </header>
    <main class="container">
HTML;
    }

    /**
     * ADICIONADO: Gera o rodapé completo da página e fecha as tags HTML.
     */
    public function rodape()
    {
        $anoAtual = date('Y');

        echo <<<HTML
    </main> <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mt-4">
                    <p class="copyright-text">&copy; {$anoAtual} - Todos os direitos reservados | Sugestões de Filmes</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
HTML;
    }

    /**
     * ADICIONADO: Monta o layout completo da página, injetando os dados na view.
     */
    public function layout($caminho, $dados = [])
    {
        // A função extract() cria as variáveis que a view precisa (ex: $listaDeCategorias)
        extract($dados);

        $this->cabecalho();

        // O caminho para a view de categoria
        include $_SERVER['DOCUMENT_ROOT'] . BASE_URL . "public/categoria/" . $caminho;

        $this->rodape();
    }
}