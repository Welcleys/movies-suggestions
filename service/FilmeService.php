<?php
namespace service;

use generic\MysqlFactory;
use dao\IFilmeDAO;
// use service\Filme; // A importação é opcional, pois estão no mesmo namespace

class FilmeService {
    
    private IFilmeDAO $dao;

    public function __construct() {
        // O Service usa a Factory para obter o DAO
        $this->dao = MysqlFactory::createFilmeDAO();
    }
    
    public function listarTodos(): array {
        // Lógica de negócio aqui (ex: validar permissões, etc.)
        // Neste caso simples, apenas repassa a chamada para o DAO.
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
        } else {
            return $this->dao->inserir($filme);
        }
    }
}