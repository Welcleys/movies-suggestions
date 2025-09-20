<?php

namespace controller;

class HomeController
{

    /**
     * Este é o método padrão que será chamado
     * quando nenhuma rota for especificada.
     */
    public function index()
    {
        // Por enquanto, vamos apenas exibir uma mensagem de boas-vindas.
        // Mais tarde, você pode carregar uma view aqui.
        echo "<h1>Bem-vindo ao Sugestões de Filmes!</h1>";
        echo "<p>Navegue pelas seções:</p>";
        echo "<ul>";
        echo '<li><a href="' . url("filme/listar") . '">Listar Filmes</a></li>';
        echo '<li><a href="' . url("categoria/listar") . '">Listar Categorias</a></li>';
        echo '<li><a href="' . url("avaliacao/listar") . '">Listar Avaliações</a></li>';
        echo "</ul>";
    }
}
