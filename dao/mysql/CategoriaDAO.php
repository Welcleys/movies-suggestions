<?php

require_once __DIR__ . '/../../generic/MysqlSingleton.php';

class CategoriaDAO
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = MysqlSingleton::getInstance()->getConnection();
    }

     public function buscarPorId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM categorias WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listar()
    {
        $stmt = $this->pdo->query("SELECT * FROM categorias");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function criar($nome)
    {
        $stmt = $this->pdo->prepare("INSERT INTO categorias (nome) VALUES (?)");
        return $stmt->execute([$nome]);
    }

    public function atualizar($id, $nome)
    {
        $stmt = $this->pdo->prepare("UPDATE categorias SET nome = ? WHERE id = ?");
        return $stmt->execute([$nome, $id]);
    }

    public function deletar($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM categorias WHERE id = ?");
        return $stmt->execute([$id]);
    }
}