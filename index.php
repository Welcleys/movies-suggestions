<?php
define("BASE_URL", "/movies-suggestions/");
require_once "generic/Autoload.php";

use generic\Controller;

$rota = $_GET["param"] ?? "";

$controller = new Controller();
$controller->verificarChamadas($rota);
