<?php
namespace template;

class HomeTemp implements ITemplate
{
    public function cabecalho()
    {
         $caminhoBase = "/movies-suggestions";

        echo <<<HTML
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sugestões de Filmes - Início</title>

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

    public function rodape()
    {
        $anoAtual = date('Y');
        echo <<<HTML
    </main>

    <footer class="site-footer">
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

    public function layout($caminho, $dados = [])
    {
        // A página inicial não precisa de dados do banco, então o extract não fará nada, mas mantemos o padrão.
        extract($dados);

        $this->cabecalho();

        // Caminho para a view da home
        include $_SERVER['DOCUMENT_ROOT'] . BASE_URL . "public/home/" . $caminho;

        $this->rodape();
    }
}