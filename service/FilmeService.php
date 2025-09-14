<?php
class FilmeService
{
    private $dao;

    public function __construct()
    {
        $this->dao = new FilmeDAO();
    }

    public function buscarFilmePorId($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            return null;
        }
        return $this->dao->buscarPorId($id);
    }

    public function listar()
    {
        return $this->dao->listar();
    }

    public function criar($titulo, $ano_lancamento, $tempo_duracao)
    {
        return $this->dao->criar($titulo, $ano_lancamento, $tempo_duracao);
    }

    public function atualizar($id, $titulo, $ano_lancamento, $tempo_duracao)
    {
        return $this->dao->atualizar($id, $titulo, $ano_lancamento, $tempo_duracao);
    }

    public function deletar($id)
    {
        return $this->dao->deletar($id);
    }
}