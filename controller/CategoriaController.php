<?php

class CategoriaController
{
    private $service;

    public function __construct()
    {
        $this->service = new CategoriaService();
    }

    public function index()
    {
        $this->listar();
    }

     public function listar()
    {
        $categorias = $this->service->listar();
       require_once __DIR__ . '/../public/categorias/listar.php';
    }

    public function criar($nome)
    {
        return $this->service->criar($nome);
    }

    public function atualizar($id, $nome)
    {
        return $this->service->atualizar($id, $nome);
    }

    public function deletar($id)
    {
        return $this->service->deletar($id);
    }
}