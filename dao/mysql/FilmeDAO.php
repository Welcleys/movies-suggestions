<?php

namespace dao\mysql;

use dao\IFilmeDAO;
use generic\MysqlSingleton;
use service\Filme;
use PDO;

class FilmeDAO implements IFilmeDAO
{

    private MysqlSingleton $banco;

    public function __construct(MysqlSingleton $conexao_banco)
    {
        $this->banco = $conexao_banco;
    }

    public function salvar(Filme $filme): int
    {
        $sql = "INSERT INTO filmes (titulo, ano_lancamento) VALUES (?, ?)";
        $params = [$filme->getTitulo(), $filme->getAnoLancamento()];
        return $this->banco->executeNonQuery($sql, $params);
    }

    public function atualizar(Filme $filme): int
    {
        $sql = "UPDATE filmes SET titulo = ?, ano_lancamento = ? WHERE id = ?";
        $params = [$filme->getTitulo(), $filme->getAnoLancamento(), $filme->getId()];
        return $this->banco->executeNonQuery($sql, $params);
    }

    public function buscarTodos(): array
    {
        $sql = "SELECT id, titulo, ano_lancamento FROM filmes";
        $stmt = $this->banco->prepared($sql);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $arrayDeFilmes = [];
        foreach ($resultados as $row) {
            $filme = new Filme();
            $filme->setId($row["id"]);
            $filme->setTitulo($row["titulo"]);
            $filme->setAnoLancamento($row["ano_lancamento"]);
            $arrayDeFilmes[] = $filme;
        }
        return $arrayDeFilmes;
    }

    public function buscarPorId(int $id): ?Filme
    {
        $sql = "SELECT id, titulo, ano_lancamento FROM filmes WHERE id = ?";
        $stmt = $this->banco->prepared($sql, [$id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            $filme = new Filme();
            $filme->setId($resultado["id"]);
            $filme->setTitulo($resultado["titulo"]);
            $filme->setAnoLancamento($resultado["ano_lancamento"]);
            return $filme;
        }
        return null;
    }

    public function deletar(int $id): int
    {
        $sql = "DELETE FROM filmes WHERE id = ?";
        return $this->banco->executeNonQuery($sql, [$id]);
    }
}
