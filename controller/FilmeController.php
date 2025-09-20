<?php
/*namespace controller;

use service\FilmeService;
use template\FilmeTemp;
use template\ITemplate;

class Filme{

    private ITemplate $template;
    private function __construct(){

        $this->template = new FilmeTemp();
    }
    
    public function listar(){

        $service = new FilmeService();
        $resultado = $service->listarFilme();
        $this->template->layout("\\public\\filme\\listar.php",$resultado);
    }
    public function inserir(){
        $nome = $_POST['nome'];
        $genero = $_POST['genero'];
        $classificacao = $_POST['classificacao'];
        $duracao = $_POST['duracao'];

        $service = new FilmeService();
        $service->inserir($filme);
        header("Location: /filme/listar");
    }

    public function atualizar(){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $genero = $_POST['genero'];
        $classificacao = $_POST['classificacao'];
        $duracao = $_POST['duracao'];

        $service = new FilmeService();
        $service->atualizar($filme);
        header("Location: /filme/listar");
    }

    public function listarId($id){
        $service = new FilmeService();
        return $service->listarId($id);
    }

    public function deletar($id){
        $service = new FilmeService();
        $service->deletar($id);
        header("Location: /filme/listar");
    }

    public static function getInstance(){
        return new Filme();
    }
}*/

namespace controller;

use generic\MysqlFactory; // <-- Use a sua Factory!

class FilmeController {

    public function listarTodos() {
        // Peça para a Factory criar o DAO para você.
        $filmeDAO = MysqlFactory::createFilmeDAO();

        // Use o DAO normalmente
        $listaDeFilmes = $filmeDAO->listar();

        // ... aqui você chamaria a sua view para renderizar a lista ...
        require 'path/to/your/view/listar.php';
    }

    public function deletarFilme($id) {
        $filmeDAO = MysqlFactory::createFilmeDAO();
        $linhasAfetadas = $filmeDAO->deletar($id);

        if ($linhasAfetadas > 0) {
            echo "Filme deletado com sucesso!";
        } else {
            echo "Filme não encontrado.";
        }
        // ... redirecionar para a página de listagem ...
    }
}
