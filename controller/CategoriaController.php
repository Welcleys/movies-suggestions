<?php
namespace controller;

use service\CategoriaService;
use service\Categoria;
use template\CategoriaTemp;

class CategoriaController {

    private CategoriaService $service;
    private CategoriaTemp $template;

    public function __construct() {
        $this->service = new CategoriaService();
        $this->template = new CategoriaTemp();
    }
    
    public function listar() {
        $listaDeCategorias = $this->service->listarTodos();
        $this->template->layout('listar.php', ['listaDeCategorias' => $listaDeCategorias]);
    }

    public function excluir(int $id) {
        $this->service->deletar($id);
        header("Location: " . BASE_URL . "categoria/listar");
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
        $this->template->layout('form.php', ['categoria' => $categoria]);
    }

    public function salvar() {
        $categoria = new Categoria();
        $categoria->setNome($_POST["nome"] ?? '');
        
        if (isset($_POST["id"]) && !empty($_POST["id"])) {
            $categoria->setId((int)$_POST["id"]);
        }
        
        $this->service->salvar($categoria);

        session_start();
        $_SESSION["mensagem"] = "Categoria salva com sucesso!";
        
        header("Location: " . BASE_URL . "categoria/listar");
        exit;
    }
}