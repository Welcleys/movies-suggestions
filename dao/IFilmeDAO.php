<?php
namespace dao;

use service\Filme;

interface IFilmeDAO {
    public function inserir(Filme $filme);
    public function atualizar(Filme $filme);
    public function deletar(int $id);
    public function buscarTodos(): array; // Mais claro que 'listar'
    public function buscarPorId(int $id): ?Filme; // Mais claro que 'listarId'
}