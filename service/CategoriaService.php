<?php
class CategoriaService
{
    private $dao;

    public function __construct()
    {
        $this->dao = new CategoriaDAO();
    }

    public function listar()
    {
        return $this->dao->listar();
    }

    public function criar($nome)
    {
        return $this->dao->criar($nome);
    }

    public function atualizar($id, $nome)
    {
        return $this->dao->atualizar($id, $nome);
    }

    public function deletar($id)
    {
        return $this->dao->deletar($id);
    }
}