<?php
class AvaliacaoController
{
    private $service;

    public function __construct()
    {
        $this->service = new AvaliacaoService();
    }

    public function index()
    {
        return $this->service->listar();
    }

    public function criar($filme_id, $categoria_id, $nota)
    {
        return $this->service->criar($filme_id, $categoria_id, $nota);
    }

    public function atualizar($id, $filme_id, $categoria_id, $nota)
    {
        return $this->service->atualizar($id, $filme_id, $categoria_id, $nota);
    }

    public function deletar($id)
    {
        return $this->service->deletar($id);
    }
}