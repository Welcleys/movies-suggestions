<?php
namespace generic;

class Controller{
    private $arrChamadas =[];
    public function __construct(){

        $this->arrChamadas = [
            ''=> new Acao('Home', 'index'),
            "filme/listar"=> new Acao('Filme', 'listar'),
            "filme/inserir"=> new Acao('Filme', 'inserir'),
            "filme/editar"=> new Acao('Filme', 'editar'),
            "filme/excluir"=> new Acao('Filme', 'excluir'),
        ];
    }

    public function verificarChamadas($rota){

        if(isset($this->arrChamadas[$rota])){
            
            $acao = $this->arrChamadas[$rota];
            $acao->executar();
            return;
    }
        
    }
}