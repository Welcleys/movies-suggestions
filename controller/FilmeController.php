<?php
class FilmeController
{
    private $service;

    public function __construct()
    {
        $this->service = new FilmeService();
    }

    // Listar todos os filmes
    public function index()
    {
        return $this->service->listar();
    }

    // Criar um novo filme
    public function criar($titulo, $ano_lancamento, $tempo_duracao)
    {
        return $this->service->criar($titulo, $ano_lancamento, $tempo_duracao);
    }

    // Atualizar um filme
    public function atualizar($id, $titulo, $ano_lancamento, $tempo_duracao)
    {
        return $this->service->atualizar($id, $titulo, $ano_lancamento, $tempo_duracao);
    }

    // Deletar um filme
    public function deletar($id)
    {
        return $this->service->deletar($id);
    }
}