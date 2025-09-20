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
        // 1. Validação da nota (continua igual)
        if ($novaAvaliacao->getNota() < 1 || $novaAvaliacao->getNota() > 10) {
            throw new \Exception("A nota da avaliação deve ser entre 1 e 10.");
        }

        // 2. Se a avaliação tem um ID, é uma edição direta do formulário. Apenas atualizamos.
        if ($novaAvaliacao->getId()) {
            return $this->dao->atualizar($novaAvaliacao);
        }

        // 3. Se é uma NOVA avaliação (sem ID), verificamos se já existe uma para este FILME.
        $avaliacaoExistente = $this->dao->buscarPorFilmeId($novaAvaliacao->getFilmeId());

        // 4. Se JÁ EXISTE uma avaliação para o filme, calculamos a média.
        if ($avaliacaoExistente) {
            // Calcula a média da nota antiga com a nota nova
            $novaNota = ($avaliacaoExistente->getNota() + $novaAvaliacao->getNota()) / 2;
            
            // Arredonda para o inteiro mais próximo para salvar no banco
            $notaFinal = round($novaNota);

            // Atualiza a nota do objeto EXISTENTE
            $avaliacaoExistente->setNota($notaFinal);

            // ATENÇÃO: Se quiser que a categoria seja atualizada para a mais recente, adicione a linha abaixo.
            // Se não, comente-a para manter a categoria da primeira avaliação.
            $avaliacaoExistente->setCategoriaId($novaAvaliacao->getCategoriaId());

            // Manda ATUALIZAR o registro que já existia no banco
            return $this->dao->atualizar($avaliacaoExistente);
        }
        
        // 5. Se NÃO EXISTE nenhuma avaliação para o filme, simplesmente insere a nova.
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