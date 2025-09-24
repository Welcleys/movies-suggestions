<?php
namespace service;

use generic\MysqlFactory;
use dao\IFilmeDAO;

class FilmeService {
    
    private IFilmeDAO $dao;

    public function __construct() {
        $this->dao = MysqlFactory::createFilmeDAO();
    }
    
    public function listarTodos(): array {
        return $this->dao->buscarTodos();
    }

    public function buscarPorId(int $id): ?Filme {
        return $this->dao->buscarPorId($id);
    }

    public function deletar(int $id): int {
        return $this->dao->deletar($id);
    }
    
    public function salvar(Filme $filme): int {
        if (empty($filme->getTitulo())) {
            throw new \Exception("O título do filme é obrigatório.");
        }

        if ($filme->getId()) {
            return $this->dao->atualizar($filme);
        }

        return $this->dao->salvar($filme);
}
}