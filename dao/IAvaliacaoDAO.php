<?php
namespace dao;

use service\Avaliacao;

interface IAvaliacaoDAO {
    public function inserir(Avaliacao $avaliacao);
    public function atualizar(Avaliacao $avaliacao);
    public function deletar(int $id);
    public function buscarTodos(): array;
    public function buscarPorId(int $id): ?Avaliacao;
    public function buscarPorFilmeECategoria(int $filmeId, int $categoriaId): ?Avaliacao;
     public function buscarPrimeiraPorFilmeId(int $filmeId): ?Avaliacao;
    public function buscarPorFilmeId(int $filmeId): ?Avaliacao;
}