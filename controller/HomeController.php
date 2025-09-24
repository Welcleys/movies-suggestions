<?php
namespace controller;

use template\HomeTemp;

class HomeController
{
    private HomeTemp $template;

    public function __construct()
    {
        $this->template = new HomeTemp();
    }

    public function index()
    {
        $this->template->layout('index.php');
    }
}