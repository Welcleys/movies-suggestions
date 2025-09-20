<?php
spl_autoload_register(
    function ($class) {
        include $class . '.php';
    }
);

if (!function_exists('url')) {
    /**
     * Gera uma URL completa baseada no caminho fornecido.
     * @param string $path O caminho a ser adicionado à URL base (ex: 'filme/listar').
     * @return string A URL completa.
     */
    function url(string $path = ''): string {
        return BASE_URL . $path;
    }
}