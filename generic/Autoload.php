<?php
spl_autoload_register(
    function ($class) {
        include $class . ".php";
    }
);

if (!function_exists("url")) {
    function url(string $path = ''): string {
        return BASE_URL . $path;
    }
}