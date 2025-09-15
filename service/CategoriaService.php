<?php
// Certifique-se de que o CategoriaDAO.php está sendo incluído
require_once __DIR__ . '/../dao/mysql/CategoriaDAO.php';

class CategoriaService
{
    private $dao;

    public function __construct()
    {
        $this->dao = new CategoriaDAO();
    }

    // Este é o método que o seu controlador precisa para a edição
    public function buscarCategoriaPorId($id)
    {
        return $this->dao->buscarPorId($id);
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