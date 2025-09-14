<?php
class AvaliacaoService
{
    private $dao;

    public function __construct()
    {
        $this->dao = new AvaliacaoDAO();
    }

    public function listar()
    {
        return $this->dao->listar();
    }

    public function criar($filme_id, $categoria_id, $nota)
    {
        return $this->dao->criar($filme_id, $categoria_id, $nota);
    }

    public function atualizar($id, $filme_id, $categoria_id, $nota)
    {
        return $this->dao->atualizar($id, $filme_id, $categoria_id, $nota);
    }

    public function deletar($id)
    {
        return $this->dao->deletar($id);
    }
}