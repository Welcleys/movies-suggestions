<?php
namespace controller;

use template\HomeTemp; // ADICIONADO

class HomeController
{
    private HomeTemp $template; // ADICIONADO

    public function __construct()
    {
        $this->template = new HomeTemp(); // ADICIONADO
    }

    public function index()
    {
        // ALTERADO: A responsabilidade agora é 100% do template.
        // O controller apenas diz qual view carregar.
        $this->template->layout('index.php');
    }
}