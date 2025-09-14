<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sugestão de Filmes</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        nav {
            background: #333;
            padding: 10px;
        }
        nav a {
            color: #fff;
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .container {
            padding: 20px;
        }
    </style>
</head>
<body>
    <nav>
        <a href="<?= BASE_URL ?>filmes/listar">Filmes</a>
        <a href="<?= BASE_URL ?>categorias/listar">Categorias</a>
        <a href="<?= BASE_URL ?>avaliacoes/listar">Avaliações</a>
    </nav>
    <div class="container">
