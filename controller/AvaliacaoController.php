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
        $this->listar();
    }
    
    public function listar()
    {
        $avaliacoes = $this->service->listar();
        require_once __DIR__ . '/../public/avaliacoes/listar.php';
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