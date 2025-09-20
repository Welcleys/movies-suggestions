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
    // 1. Cláusula de Guarda (Guard Clause) para validação.
    // Se o título estiver vazio, lança uma exceção e a função para aqui.
    if (empty($filme->getTitulo())) {
        throw new \Exception("O título do filme é obrigatório.");
    }

    // 2. Condição para ATUALIZAR (Early Return)
    // Se o filme já tem um ID, ele é atualizado e a função retorna.
    if ($filme->getId()) {
        return $this->dao->atualizar($filme);
    }

    // 3. Ação Padrão para INSERIR
    // Se o código chegou até aqui, é porque o filme não tinha ID.
    // Então, ele é inserido como um novo registro.
    return $this->dao->salvar($filme);
}
}