<?php
namespace controller;

use service\AvaliacaoService;
use service\FilmeService;
use service\CategoriaService;
use service\Avaliacao;

class AvaliacaoController {

    private AvaliacaoService $service;

    public function __construct() {
        $this->service = new AvaliacaoService();
    }
    
    public function listar() {
        $listaDeAvaliacoes = $this->service->listarTodos();
        require_once 'public/avaliacao/listar.php';
    }

    public function excluir(int $id) {
        $this->service->deletar($id);
        header('Location: index.php?param=avaliacao/listar');
        exit;
    }
    
    public function form(?int $id = null) {
        $avaliacao = null;
        if ($id) {
            $avaliacao = $this->service->buscarPorId($id);
        }
        
        // MUDANÇA IMPORTANTE: Buscar filmes e categorias para os dropdowns
        $filmeService = new FilmeService();
        $listaDeFilmes = $filmeService->listarTodos();

        $categoriaService = new CategoriaService();
        $listaDeCategorias = $categoriaService->listarTodos();
        
        // Passa todas as informações para a view
        require_once 'public/avaliacao/form.php';
    }

    public function salvar() {
        $avaliacao = new Avaliacao();
        $avaliacao->setFilmeId((int)($_POST['filme_id'] ?? 0));
        $avaliacao->setCategoriaId((int)($_POST['categoria_id'] ?? 0));
        $avaliacao->setNota((int)($_POST['nota'] ?? 0));
        
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $avaliacao->setId((int)$_POST['id']);
        }
        
        $this->service->salvar($avaliacao);

        session_start();
        $_SESSION['mensagem'] = "Avaliação salva com sucesso!";
        
        header('Location: index.php?param=avaliacao/listar');
        exit;
    }

    public function getCategoriaDoFilme() {
        // Pega o ID do filme enviado via GET pelo JavaScript
        $filmeId = (int)($_GET['filme_id'] ?? 0);
        
        $categoriaId = $this->service->buscarPrimeiraCategoriaPorFilme($filmeId);

        // Define o cabeçalho como JSON para o navegador entender a resposta
        header('Content-Type: application/json');
        
        // Retorna um objeto JSON simples. Ex: {"categoria_id": 5} ou {"categoria_id": null}
        echo json_encode(['categoria_id' => $categoriaId]);
    }
}