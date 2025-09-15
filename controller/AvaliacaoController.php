<?php
class AvaliacaoController
{
    private $avaliacaoService;
    private $filmeService;
    private $categoriaService;

    public function __construct()
    {
        $this->avaliacaoService = new AvaliacaoService();
        $this->filmeService = new FilmeService();
        $this->categoriaService = new CategoriaService();
    }

    public function index()
    {
        $this->listar();
    }

    public function listar()
    {
        $avaliacoes = $this->avaliacaoService->listar();
        require_once __DIR__ . '/../public/avaliacoes/listar.php';
    }

    public function adicionar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->avaliacaoService->criar(
                $_POST['filme_id'],
                $_POST['categoria_id'],
                $_POST['nota']
            );

            header("Location: " . BASE_URL . "avaliacoes/listar");
            exit;
        }

        $filmes = $this->filmeService->listar();
        $categorias = $this->categoriaService->listar();

        require_once __DIR__ . '/../public/avaliacoes/adicionar.php';
    }

    public function atualizar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->avaliacaoService->atualizar(
                $id,
                $_POST['filme_id'],
                $_POST['categoria_id'],
                $_POST['nota']
            );
            header("Location: " . BASE_URL . "avaliacoes/listar");
            exit;
        }
    }

    public function deletar()
{
    $id = $_GET['id'] ?? null;

    if ($id) {
        $this->avaliacaoService->deletar($id);
    }

    header("Location: " . BASE_URL . "avaliacoes/listar");
    exit;
}
}