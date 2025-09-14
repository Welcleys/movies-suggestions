<?php
// autoload.php

spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/../controller/',
        __DIR__ . '/../dao/mysql/',
        __DIR__ . '/../generic/', 
        __DIR__ . '/../service/',
        __DIR__ . '/../public/avaliacoes/',
        __DIR__ . '/../public/categorias/',
        __DIR__ . '/../public/filmes/',
        __DIR__ . '/../view/',
    ];

    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});