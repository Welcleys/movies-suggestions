<?php
namespace service;

use generic\MysqlFactory;
use dao\IAvaliacaoDAO;

class AvaliacaoService {
    
    private IAvaliacaoDAO $dao;

    public function __construct() {
        $this->dao = MysqlFactory::createAvaliacaoDAO();
    }
    
    public function listarTodos(): array {
        return $this->dao->buscarTodos();
    }

    public function buscarPorId(int $id): ?Avaliacao {
        return $this->dao->buscarPorId($id);
    }

    public function deletar(int $id): int {
        return $this->dao->deletar($id);
    }

    public function salvar(Avaliacao $novaAvaliacao): int {
        if ($novaAvaliacao->getNota() < 1 || $novaAvaliacao->getNota() > 10) {
            throw new \Exception("A nota da avaliação deve ser entre 1 e 10.");
        }
        if ($novaAvaliacao->getId()) {
            return $this->dao->atualizar($novaAvaliacao);
        }

        $avaliacaoExistente = $this->dao->buscarPorFilmeId($novaAvaliacao->getFilmeId());

        if ($avaliacaoExistente) {
            $novaNota = ($avaliacaoExistente->getNota() + $novaAvaliacao->getNota()) / 2;
            
            $notaFinal = round($novaNota);

            $avaliacaoExistente->setNota($notaFinal);

            $avaliacaoExistente->setCategoriaId($novaAvaliacao->getCategoriaId());

            return $this->dao->atualizar($avaliacaoExistente);
        }

        return $this->dao->inserir($novaAvaliacao);
    }

    public function buscarPrimeiraCategoriaPorFilme(int $filmeId): ?int {
        $primeiraAvaliacao = $this->dao->buscarPrimeiraPorFilmeId($filmeId);
        if ($primeiraAvaliacao) {
            return $primeiraAvaliacao->getCategoriaId();
        }
        return null;
    }
}