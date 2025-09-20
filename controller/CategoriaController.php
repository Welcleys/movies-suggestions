<?php
namespace controller;

use service\CategoriaService;
use service\Categoria;

class CategoriaController {

    private CategoriaService $service;

    public function __construct() {
        $this->service = new CategoriaService();
    }
    
    public function listar() {
        $listaDeCategorias = $this->service->listarTodos();
        require_once 'public/categoria/listar.php';
    }

    public function excluir(int $id) {
        $this->service->deletar($id);
        header('Location: index.php?param=categoria/listar');
        exit;
    }
    
    public function form(?int $id = null) {
        $categoria = null;
        if ($id) {
            $categoria = $this->service->buscarPorId($id);
            if (!$categoria) {
                echo "Categoria não encontrada!";
                exit;
            }
        }
        require_once 'public/categoria/form.php';
    }

    public function salvar() {
        $categoria = new Categoria();
        $categoria->setNome($_POST['nome'] ?? '');
        
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $categoria->setId((int)$_POST['id']);
        }
        
        $this->service->salvar($categoria);

        session_start();
        $_SESSION['mensagem'] = "Categoria salva com sucesso!";
        
        header('Location: index.php?param=categoria/listar');
        exit;
    }
}