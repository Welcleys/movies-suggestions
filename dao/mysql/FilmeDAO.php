<?php
class FilmeDAO
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = MysqlSingleton::getInstance()->getConnection();
    }

    public function buscarPorId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM filmes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function listar()
    {
        $stmt = $this->pdo->query("SELECT * FROM filmes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function criar($titulo, $ano_lancamento, $tempo_duracao)
    {
        $stmt = $this->pdo->prepare("INSERT INTO filmes (titulo, ano_lancamento, tempo_duracao) VALUES (?, ?, ?)");
        return $stmt->execute([$titulo, $ano_lancamento, $tempo_duracao]);
    }

    public function atualizar($id, $titulo, $ano_lancamento, $tempo_duracao)
    {
        $stmt = $this->pdo->prepare("UPDATE filmes SET titulo = ?, ano_lancamento = ?, tempo_duracao = ? WHERE id = ?");
        return $stmt->execute([$titulo, $ano_lancamento, $tempo_duracao, $id]);
    }

    public function deletar($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM filmes WHERE id = ?");
        return $stmt->execute([$id]);
    }
}