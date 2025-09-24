<?php
namespace controller;

use service\FilmeService;
use service\Filme;
use template\FilmeTemp;

class FilmeController {

    private FilmeService $service;
    private FilmeTemp $template;

    public function __construct() {
        $this->service = new FilmeService();
        $this->template = new FilmeTemp();
    }
    
    public function listar() {
        $listaDeFilmes = $this->service->listarTodos();
        $this->template->layout('listar.php', ['listaDeFilmes' => $listaDeFilmes]);
    }

    public function excluir(int $id) {
        $this->service->deletar($id);
             
        header("Location: " . url("filme/listar"));
        exit;
    }

    public function form(?int $id = null) {
        $filme = null;
        if ($id) {
            $filme = $this->service->buscarPorId($id);
            if (!$filme) {
                echo "Filme não encontrado!";
                exit;
            }
        }

        $this->template->layout('form.php', ['filme' => $filme]);
    }

    public function salvar() {
        $filme = new Filme();
        $filme->setTitulo($_POST['titulo'] ?? '');
        $filme->setAnoLancamento((int)($_POST['ano_lancamento'] ?? 0));
        
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $filme->setId((int)$_POST['id']);
        }

        $this->service->salvar($filme);
    
        session_start();
        $_SESSION["mensagem"] = "Filme salvo com sucesso!";

        header("Location: " . BASE_URL . "filme/listar");
        exit;
    }
}