<?php
namespace dao;

use service\Filme;

interface IFilmeDAO {
    public function salvar(Filme $filme);
    public function atualizar(Filme $filme);
    public function deletar(int $id);
    public function buscarTodos(): array;
    public function buscarPorId(int $id): ?Filme;
}