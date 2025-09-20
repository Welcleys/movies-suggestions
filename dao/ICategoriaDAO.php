<?php
namespace dao;

use service\Categoria; // Importa nosso novo modelo

interface ICategoriaDAO {
    public function inserir(Categoria $categoria);
    public function atualizar(Categoria $categoria);
    public function deletar(int $id);
    public function buscarTodos(): array;
    public function buscarPorId(int $id): ?Categoria;
}