<?php
namespace service;

use generic\MysqlFactory;
use dao\ICategoriaDAO;

class CategoriaService {
    
    private ICategoriaDAO $dao;

    public function __construct() {
        $this->dao = MysqlFactory::createCategoriaDAO();
    }
    
    public function listarTodos(): array {
        return $this->dao->buscarTodos();
    }

    public function buscarPorId(int $id): ?Categoria {
        return $this->dao->buscarPorId($id);
    }

    public function deletar(int $id): int {
        return $this->dao->deletar($id);
    }
    
    public function salvar(Categoria $categoria): int {
        if (empty($categoria->getNome())) {
            throw new \Exception("O nome da categoria é obrigatório.");
        }

        if ($categoria->getId()) {
            return $this->dao->atualizar($categoria);
        }
        return $this->dao->inserir($categoria);
    }
}