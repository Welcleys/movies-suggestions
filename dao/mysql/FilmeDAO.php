<?php
/*namespace dao\mysql;

use dao\IFilmeDAO;
use generic\MysqlFactory;

class FilmeDAO extends MysqlFactory implements IFilmeDAO {
    
    public function inserir($filme) {
        $sql = "INSERT INTO filmes (nome, genero, classificacao, duracao) VALUES (?, ?, ?, ?)";
        $params = [$filme->getNome(), $filme->getGenero(), $filme->getClassificacao(), $filme->getDuracao()];
        return $this->banco->executar($sql, $params);
    }

    public function atualizar($filme) {
        $sql = "UPDATE filmes SET nome = ?, genero = ?, classificacao = ?, duracao = ? WHERE id = ?";
        $params = [$filme->getNome(), $filme->getGenero(), $filme->getClassificacao(), $filme->getDuracao(), $filme->getId()];
        return $this->banco->executar($sql, $params);
    }

    public function listar() {
        $sql = "SELECT * FROM filmes";
        return $this->banco->executar($sql);
    }

    public function listarId($id) {
        $sql = "SELECT * FROM filmes WHERE id = ?";
        $retorno = $this->banco->executar($sql, [$id]);
        return count($retorno) > 0 ? $retorno[0] : null;
    }

    public function deletar($id) {
        $sql = "DELETE FROM filmes WHERE id = ?";
        return $this->banco->executar($sql, [$id]);
    }
}*/


namespace dao\mysql;

use dao\IFilmeDAO;
use generic\MysqlSingleton; // <-- Importante: use a classe Singleton
use PDO;

// NÃO use "extends MysqlFactory". Apenas implemente a interface.
class FilmeDAO implements IFilmeDAO {
    
    private MysqlSingleton $banco;

    // O construtor recebe a conexão. Quem vai fornecer é a Factory!
    public function __construct(MysqlSingleton $conexao_banco) {
        $this->banco = $conexao_banco;
    }
    
    // Seus métodos agora usam a propriedade `$this->banco`
    public function inserir($filme) {
        $sql = "INSERT INTO filmes (nome, genero, classificacao, duracao) VALUES (?, ?, ?, ?)";
        $params = [$filme->getNome(), $filme->getGenero(), $filme->getClassificacao(), $filme->getDuracao()];
        return $this->banco->executeNonQuery($sql, $params);
    }

    public function atualizar($filme) {
        $sql = "UPDATE filmes SET nome = ?, genero = ?, classificacao = ?, duracao = ? WHERE id = ?";
        $params = [
            $filme->getNome(), 
            $filme->getGenero(), 
            $filme->getClassificacao(), 
            $filme->getDuracao(), 
            $filme->getId() // <-- Pega o ID do objeto
        ];
        return $this->banco->executeNonQuery($sql, $params);
    }

    public function alterar($id, $filme) {
        $sql = "UPDATE filmes SET nome = ?, genero = ?, classificacao = ?, duracao = ? WHERE id = ?";
        $params = [
            $filme->getNome(), 
            $filme->getGenero(), 
            $filme->getClassificacao(), 
            $filme->getDuracao(), 
            $id // <-- Pega o ID do parâmetro da função
        ];
        return $this->banco->executeNonQuery($sql, $params);
    }
    
    public function listar() {
        $sql = "SELECT * FROM filmes";
        $stmt = $this->banco->prepared($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarId($id) {
        $sql = "SELECT * FROM filmes WHERE id = ?";
        $stmt = $this->banco->prepared($sql, [$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function deletar($id) {
        $sql = "DELETE FROM filmes WHERE id = ?";
        return $this->banco->executeNonQuery($sql, [$id]);
    }
}