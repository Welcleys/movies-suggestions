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
        $partesDaRota = explode("/", $rota);
        $rotaBase = $partesDaRota[0] . (isset($partesDaRota[1]) ? "/" . $partesDaRota[1] : "");
        $params = count($partesDaRota) > 2 ? array_slice($partesDaRota, 2) : [];

        if (array_key_exists($rotaBase, $this->arrChamadas)) {

            $acaoBase = $this->arrChamadas[$rotaBase];

            $acaoComParams = new Acao(
                str_replace("Controller", "", substr($acaoBase->classe, 11)),
                $acaoBase->metodo, 
                $params
            );

            try {
                $acaoComParams->executar();
            } catch (\Exception $e) {
                echo "<h1>Erro na Aplicação</h1><p>" . $e->getMessage() . "</p>";
            }
            return; 
        }

        if (isset($this->arrChamadas[$rota]) && $rota === "") {
            $acao = $this->arrChamadas[$rota];
            $acao->executar();
            return;
        }
                
        echo "Erro 404: Rota não encontrada.";
    }
}
