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
        return $this->service->listar();
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