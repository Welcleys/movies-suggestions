<?php

namespace controller;

class HomeController
{
    public function index()
    {
        echo "<h1>Bem-vindo ao Sugestões de Filmes!</h1>";
        echo "<br>";
        echo "<h2>Aplicação ainda em costrução!</h2>";
        echo "<br>";
        echo "<p>Navegue pelas seções:</p>";
        echo "<ul>";
        echo '<li><a href="' . url("filme/listar") . '">Listar Filmes</a></li>';
        echo '<li><a href="' . url("categoria/listar") . '">Listar Categorias</a></li>';
        echo '<li><a href="' . url("avaliacao/listar") . '">Listar Avaliações</a></li>';
        echo "</ul>";
    }
}
