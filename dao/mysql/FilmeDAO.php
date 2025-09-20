<?php
namespace dao\mysql;

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
}