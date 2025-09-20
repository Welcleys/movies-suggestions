<?php
namespace generic;

class Controller
{
    private array $arrChamadas = [];

    public function __construct()
    {
        $this->arrChamadas = [
            "" => new Acao("Home", "index"),
            "filme/listar" => new Acao("Filme", "listar"),
            "filme/salvar" => new Acao("Filme", "salvar"),
            "filme/excluir" => new Acao("Filme", "excluir"),
            "filme/form" => new Acao("Filme", "form"),
            "categoria/listar" => new Acao("Categoria", "listar"),
            "categoria/form" => new Acao("Categoria", "form"),
            "categoria/salvar" => new Acao("Categoria", "salvar"),
            "categoria/excluir" => new Acao("Categoria", "excluir"),
            "avaliacao/listar" => new Acao("Avaliacao", "listar"),
            "avaliacao/form" => new Acao("Avaliacao", "form"),
            "avaliacao/salvar" => new Acao("Avaliacao", "salvar"),
            "avaliacao/excluir" => new Acao("Avaliacao", "excluir"),
            "avaliacao/get-categoria-do-filme" => new Acao("Avaliacao", "getCategoriaDoFilme"),
        ];
    }

    public function verificarChamadas($rota)
    {
        // Divide a rota da URL em partes. Ex: 'filme/excluir/5' vira ['filme', 'excluir', '5']
        $partesDaRota = explode('/', $rota);

        // Define as rotas base que podem ter parâmetros (normalmente com 2 partes)
        $rotaBase = $partesDaRota[0] . (isset($partesDaRota[1]) ? '/' . $partesDaRota[1] : '');

        // Define os parâmetros (tudo que vem depois da rota base)
        $params = count($partesDaRota) > 2 ? array_slice($partesDaRota, 2) : [];

        // VERIFICAÇÃO PRINCIPAL: A rota base (ex: 'filme/excluir') existe no nosso mapa?
        if (array_key_exists($rotaBase, $this->arrChamadas)) {

            // Pega o objeto Acao base (sem parâmetros) do mapa
            $acaoBase = $this->arrChamadas[$rotaBase];

            // Cria uma NOVA instância de Acao, passando os parâmetros que encontramos na URL
            $acaoComParams = new Acao(
                str_replace('Controller', '', substr($acaoBase->classe, 11)), // Pega o nome base da classe, ex: 'Filme'
                $acaoBase->metodo, // Pega o nome do método, ex: 'excluir'
                $params            // Adiciona os parâmetros, ex: ['5']
            );

            try {
                $acaoComParams->executar();
            } catch (\Exception $e) {
                echo "<h1>Erro na Aplicação</h1><p>" . $e->getMessage() . "</p>";
            }

            return; // Encerra a execução pois a rota foi encontrada
        }

        // Tratamento para a rota da home page (string vazia)
        if (isset($this->arrChamadas[$rota]) && $rota === "") {
            $acao = $this->arrChamadas[$rota];
            $acao->executar();
            return;
        }

        echo "Erro 404: Rota não encontrada.";
    }
}
