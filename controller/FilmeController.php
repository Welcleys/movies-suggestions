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

    public function adicionar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->service->criar(
                $_POST['titulo'],
                $_POST['ano_lancamento'],
                $_POST['tempo_duracao']
            );
            
            header("Location: " . BASE_URL . "filmes/listar");
            exit;
        }
        require_once __DIR__ . '/../public/filmes/adicionar.php';
    }

    public function buscarPorId($id)
    {
        return $this->service->buscarFilmePorId($id);
    }

    public function atualizar($id, $titulo, $ano_lancamento, $tempo_duracao)
    {
        return $this->service->atualizar($id, $titulo, $ano_lancamento, $tempo_duracao);
    }

    public function deletar()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->service->deletar($id);
        }

        header("Location: " . BASE_URL . "filmes/listar");
        exit;
    }
}