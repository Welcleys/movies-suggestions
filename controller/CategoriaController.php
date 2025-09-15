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

    public function adicionar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->service->criar($_POST['nome']);
            header("Location: " . BASE_URL . "categorias/listar");
            exit;
        }
        require_once __DIR__ . '/../public/categorias/adicionar.php';
    }

    public function atualizar()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: " . BASE_URL . "categorias/listar");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->service->atualizar($id, $_POST['nome']);
            header("Location: " . BASE_URL . "categorias/listar");
            exit;
        }

        $categoria = $this->service->buscarCategoriaPorId($id);
        require_once __DIR__ . '/../public/categorias/editar.php';;
    }

    public function deletar()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->service->deletar($id);
        }

        header("Location: " . BASE_URL . "categorias/listar");
        exit;
    }
}