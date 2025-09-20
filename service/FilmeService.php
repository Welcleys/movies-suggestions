<?php
namespace service;

use dao\mysql\FilmeDAO;

class FilmeService extends FilmeDAO {
    public function listarFilme(){

        return parent::listar();
    }

    public function inserir($filme){
        return parent::inserir($filme);
    }

    public function atualizar($filme){
        return parent::atualizar($filme);
    }
    public function listarId($id){
        return parent::listarId($id);
    }
    public function deletar($id){
        return parent::deletar($id);
    }
}
