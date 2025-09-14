<?php
spl_autoload_register(function ($class) { 
    $paths = [
        __DIR__ . '/../controller/',
        __DIR__ . '/../dao/',
        __DIR__ . '/../service/',
        __DIR__ . '/../public/',
        __DIR__ . '/../view/',
        __DIR__ . '/../config/',
    ];

    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});