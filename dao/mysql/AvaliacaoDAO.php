<?php
namespace dao\mysql;

use dao\IAvaliacaoDAO;
use generic\MysqlSingleton;
use service\Avaliacao;
use PDO;

class AvaliacaoDAO implements IAvaliacaoDAO {
    
    private MysqlSingleton $banco;

    public function __construct(MysqlSingleton $conexao_banco) {
        $this->banco = $conexao_banco;
    }
    
    public function inserir(Avaliacao $avaliacao): int {
        $sql = "INSERT INTO avaliacoes (filme_id, categoria_id, nota) VALUES (?, ?, ?)";
        $params = [$avaliacao->getFilmeId(), $avaliacao->getCategoriaId(), $avaliacao->getNota()];
        return $this->banco->executeNonQuery($sql, $params);
    }

    public function atualizar(Avaliacao $avaliacao): int {
        $sql = "UPDATE avaliacoes SET filme_id = ?, categoria_id = ?, nota = ? WHERE id = ?";
        $params = [$avaliacao->getFilmeId(), $avaliacao->getCategoriaId(), $avaliacao->getNota(), $avaliacao->getId()];
        return $this->banco->executeNonQuery($sql, $params);
    }

    public function deletar(int $id): int {
        $sql = "DELETE FROM avaliacoes WHERE id = ?";
        return $this->banco->executeNonQuery($sql, [$id]);
    }
    
    public function buscarTodos(): array {
        $sql = "SELECT a.id, a.filme_id, a.categoria_id, a.nota, f.titulo as filme_titulo, c.nome as categoria_nome 
                FROM avaliacoes a
                JOIN filmes f ON a.filme_id = f.id
                JOIN categorias c ON a.categoria_id = c.id
                ORDER BY a.id ASC";
        
        $stmt = $this->banco->prepared($sql);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $arrayDeAvaliacoes = [];
        foreach ($resultados as $row) {
            $avaliacao = new Avaliacao();
            $avaliacao->setId($row["id"]);
            $avaliacao->setFilmeId($row["filme_id"]);
            $avaliacao->setCategoriaId($row["categoria_id"]);
            $avaliacao->setNota($row["nota"]);
            $avaliacao->setFilmeTitulo($row["filme_titulo"]);
            $avaliacao->setCategoriaNome($row["categoria_nome"]);
            $arrayDeAvaliacoes[] = $avaliacao;
        }
        return $arrayDeAvaliacoes;
    }

    public function buscarPorId(int $id): ?Avaliacao {
        $sql = "SELECT id, filme_id, categoria_id, nota FROM avaliacoes WHERE id = ?";
        $stmt = $this->banco->prepared($sql, [$id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            $avaliacao = new Avaliacao();
            $avaliacao->setId($resultado["id"]);
            $avaliacao->setFilmeId($resultado["filme_id"]);
            $avaliacao->setCategoriaId($resultado["categoria_id"]);
            $avaliacao->setNota($resultado["nota"]);
            return $avaliacao;
        }
        return null;
    }

    public function buscarPorFilmeECategoria(int $filmeId, int $categoriaId): ?Avaliacao {
        $sql = "SELECT * FROM avaliacoes WHERE filme_id = ? AND categoria_id = ?";
        $stmt = $this->banco->prepared($sql, [$filmeId, $categoriaId]);
        $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($resultado) {
            $avaliacao = new \service\Avaliacao();
            $avaliacao->setId($resultado["id"]);
            $avaliacao->setFilmeId($resultado["filme_id"]);
            $avaliacao->setCategoriaId($resultado["categoria_id"]);
            $avaliacao->setNota($resultado["nota"]);
            return $avaliacao;
        }
        return null;
    }

    public function buscarPrimeiraPorFilmeId(int $filmeId): ?\service\Avaliacao {
        $sql = "SELECT * FROM avaliacoes WHERE filme_id = ? ORDER BY id ASC LIMIT 1";
        $stmt = $this->banco->prepared($sql, [$filmeId]);
        $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($resultado) {
            $avaliacao = new \service\Avaliacao();
            $avaliacao->setId($resultado["id"]);
            $avaliacao->setFilmeId($resultado["filme_id"]);
            $avaliacao->setCategoriaId($resultado["categoria_id"]);
            $avaliacao->setNota($resultado["nota"]);
            return $avaliacao;
        }
        return null;
    }

    public function buscarPorFilmeId(int $filmeId): ?\service\Avaliacao {
        $sql = "SELECT * FROM avaliacoes WHERE filme_id = ? LIMIT 1";
        $stmt = $this->banco->prepared($sql, [$filmeId]);
        $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($resultado) {
            $avaliacao = new \service\Avaliacao();
            $avaliacao->setId($resultado["id"]);
            $avaliacao->setFilmeId($resultado["filme_id"]);
            $avaliacao->setCategoriaId($resultado["categoria_id"]);
            $avaliacao->setNota($resultado["nota"]);
            return $avaliacao;
        }
        return null;
    }
}