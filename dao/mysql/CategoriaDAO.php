<?php
namespace dao\mysql;

use dao\ICategoriaDAO;
use generic\MysqlSingleton;
use service\Categoria;
use PDO;

class CategoriaDAO implements ICategoriaDAO {
    
    private MysqlSingleton $banco;

    public function __construct(MysqlSingleton $conexao_banco) {
        $this->banco = $conexao_banco;
    }
    
    public function inserir(Categoria $categoria): int {
        $sql = "INSERT INTO categorias (nome) VALUES (?)";
        $params = [$categoria->getNome()];
        return $this->banco->executeNonQuery($sql, $params);
    }

    public function atualizar(Categoria $categoria): int {
        $sql = "UPDATE categorias SET nome = ? WHERE id = ?";
        $params = [$categoria->getNome(), $categoria->getId()];
        return $this->banco->executeNonQuery($sql, $params);
    }

    public function deletar(int $id): int {
        $sql = "DELETE FROM categorias WHERE id = ?";
        return $this->banco->executeNonQuery($sql, [$id]);
    }
    
    public function buscarTodos(): array {
        $sql = "SELECT id, nome FROM categorias";
        $stmt = $this->banco->prepared($sql);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $arrayDeCategorias = [];
        foreach ($resultados as $row) {
            $categoria = new Categoria();
            $categoria->setId($row["id"]);
            $categoria->setNome($row["nome"]);
            $arrayDeCategorias[] = $categoria;
        }
        return $arrayDeCategorias;
    }

    public function buscarPorId(int $id): ?Categoria {
        $sql = "SELECT id, nome FROM categorias WHERE id = ?";
        $stmt = $this->banco->prepared($sql, [$id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            $categoria = new Categoria();
            $categoria->setId($resultado["id"]);
            $categoria->setNome($resultado["nome"]);
            return $categoria;
        }
        return null;
    }
}