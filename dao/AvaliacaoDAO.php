<?php
class AvaliacaoDAO
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = MysqlSingleton::getInstance()->getConnection();
    }

    public function listar()
    {
        $sql = "SELECT a.id, f.titulo AS filme, c.nome AS categoria, a.nota
                FROM avaliacoes a
                JOIN filmes f ON a.filme_id = f.id
                JOIN categorias c ON a.categoria_id = c.id";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function criar($filme_id, $categoria_id, $nota)
    {
        $stmt = $this->pdo->prepare("INSERT INTO avaliacoes (filme_id, categoria_id, nota) VALUES (?, ?, ?)");
        return $stmt->execute([$filme_id, $categoria_id, $nota]);
    }

    public function atualizar($id, $filme_id, $categoria_id, $nota)
    {
        $stmt = $this->pdo->prepare("UPDATE avaliacoes SET filme_id = ?, categoria_id = ?, nota = ? WHERE id = ?");
        return $stmt->execute([$filme_id, $categoria_id, $nota, $id]);
    }

    public function deletar($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM avaliacoes WHERE id = ?");
        return $stmt->execute([$id]);
    }
}