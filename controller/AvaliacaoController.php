<?php
namespace controller;

use service\AvaliacaoService;
use service\FilmeService;
use service\CategoriaService;
use service\Avaliacao;
use template\AvaliacaoTemp;


class AvaliacaoController {

    private AvaliacaoService $service;
    private AvaliacaoTemp $template;


    public function __construct() {
        $this->service = new AvaliacaoService();
        $this->template = new AvaliacaoTemp();

    }
    
    public function listar() {
        $listaDeAvaliacoes = $this->service->listarTodos();
        $this->template->layout('listar.php', ['listaDeAvaliacoes' => $listaDeAvaliacoes]);
    }

    public function excluir(int $id) {
        $this->service->deletar($id);
        header("Location: " . BASE_URL . "avaliacao/listar");
        exit;
    }
    
    public function form(?int $id = null) {
        $avaliacao = null;
        if ($id) {
            $avaliacao = $this->service->buscarPorId($id);
        }
        
        $filmeService = new FilmeService();
        $listaDeFilmes = $filmeService->listarTodos();

        $categoriaService = new CategoriaService();
        $listaDeCategorias = $categoriaService->listarTodos();
        
        $this->template->layout('form.php', [
            'avaliacao' => $avaliacao,
            'listaDeFilmes' => $listaDeFilmes,
            'listaDeCategorias' => $listaDeCategorias
        ]);
    }

    public function salvar() {
        $avaliacao = new Avaliacao();
        $avaliacao->setFilmeId((int)($_POST["filme_id"] ?? 0));
        $avaliacao->setCategoriaId((int)($_POST["categoria_id"] ?? 0));
        $avaliacao->setNota((int)($_POST["nota"] ?? 0));
        
        if (isset($_POST["id"]) && !empty($_POST["id"])) {
            $avaliacao->setId((int)$_POST["id"]);
        }
        
        $this->service->salvar($avaliacao);

        session_start();
        $_SESSION["mensagem"] = "Avaliação salva com sucesso!";
        
        header("Location: " . BASE_URL . "avaliacao/listar");
        exit;
    }

    public function getCategoriaDoFilme() {
        $filmeId = (int)($_GET['filme_id'] ?? 0);
        
        $categoriaId = $this->service->buscarPrimeiraCategoriaPorFilme($filmeId);

        header('Content-Type: application/json');
        
        echo json_encode(['categoria_id' => $categoriaId]);
    }
}