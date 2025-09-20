<?php
/*include "generic/Autoload.php";

use generic\Controller;

if(isset($_GET["param"])){
    $controller = new Controller();
    $controller->verificarChamadas($_GET["param"]);
}*/

require_once "generic/Autoload.php";

use generic\Controller;

// Define uma rota padrão vazia se nenhum parâmetro for passado (para a home)
$rota = $_GET["param"] ?? "";

$controller = new Controller();
$controller->verificarChamadas($rota);