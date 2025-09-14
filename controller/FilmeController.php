<?php
class FilmeController
{
    private $service;

    public function __construct()
    {
        $this->service = new FilmeService();
    }

    public function index()
    {
        $this->listar();
    } 
    
    public function listar()
    {
        $filmes = $this->service->listar();
        require_once __DIR__ . '/../public/filmes/listar.php';
    }

    public function buscarPorId($id)
    {
        return $this->service->buscarFilmePorId($id);
    }

    public function criar($titulo, $ano_lancamento, $tempo_duracao)
    {
        return $this->service->criar($titulo, $ano_lancamento, $tempo_duracao);
    }

    public function atualizar($id, $titulo, $ano_lancamento, $tempo_duracao)
    {
        return $this->service->atualizar($id, $titulo, $ano_lancamento, $tempo_duracao);
    }

    public function deletar($id)
    {
        return $this->service->deletar($id);
    }
}