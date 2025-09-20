<?php
/*namespace controller;

use service\FilmeService;
use template\FilmeTemp;
use template\ITemplate;

class Filme{

    private ITemplate $template;
    private function __construct(){

        $this->template = new FilmeTemp();
    }
    
    public function listar(){

        $service = new FilmeService();
        $resultado = $service->listarFilme();
        $this->template->layout("\\public\\filme\\listar.php",$resultado);
    }
    public function inserir(){
        $nome = $_POST['nome'];
        $genero = $_POST['genero'];
        $classificacao = $_POST['classificacao'];
        $duracao = $_POST['duracao'];

        $service = new FilmeService();
        $service->inserir($filme);
        header("Location: /filme/listar");
    }

    public function atualizar(){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $genero = $_POST['genero'];
        $classificacao = $_POST['classificacao'];
        $duracao = $_POST['duracao'];

        $service = new FilmeService();
        $service->atualizar($filme);
        header("Location: /filme/listar");
    }

    public function listarId($id){
        $service = new FilmeService();
        return $service->listarId($id);
    }

    public function deletar($id){
        $service = new FilmeService();
        $service->deletar($id);
        header("Location: /filme/listar");
    }

    public static function getInstance(){
        return new Filme();
    }
}*/

namespace controller;

use service\FilmeService;
use service\Filme; // Lembre-se que nossa classe Filme está no namespace 'service'

class FilmeController {

    private FilmeService $service;

    /**
     * O construtor é chamado automaticamente quando o Controller é criado.
     * Ele prepara as dependências que a classe irá usar.
     */
    public function __construct() {
        $this->service = new FilmeService();
    }
    
    /**
     * Ação: LISTAR
     * Busca todos os filmes através do serviço e carrega a view de listagem.
     */
    public function listar() {
        // O service nos retorna um array de objetos 'Filme'
        $listaDeFilmes = $this->service->listarTodos();
        
        // O require_once torna a variável $listaDeFilmes disponível dentro da view
        require_once 'public/filme/listar.php';
    }

    /**
     * Ação: EXCLUIR
     * Recebe um ID da URL, manda o serviço deletar e redireciona para a lista.
     */
    public function excluir(int $id) {
        $this->service->deletar($id);
        
        // É uma boa prática redirecionar após uma ação de POST, PUT ou DELETE
        header('Location: index.php?param=filme/listar');
        exit; // Garante que o script pare a execução após o redirecionamento
    }
    
    /**
     * Ação: EXIBIR FORMULÁRIO
     * Exibe o formulário para adicionar um novo filme ou para editar um existente.
     */
    public function form(?int $id = null) {
        $filme = null;
        if ($id) {
            // Se um ID foi passado, busca o filme para preencher o formulário
            $filme = $this->service->buscarPorId($id);
            if (!$filme) {
                // Se o filme não for encontrado, redireciona ou mostra erro
                echo "Filme não encontrado!";
                exit;
            }
        }
        // Carrega a view do formulário. A variável $filme estará disponível lá
        // (seja com os dados do filme ou como null)
        require_once 'public/filme/form.php';
    }

    /**
     * Ação: SALVAR
     * Processa os dados enviados pelo formulário (tanto para inserir quanto para atualizar).
     */
    public function salvar() {
        // 1. Cria um objeto Filme e o preenche com os dados do formulário ($_POST)
        $filme = new Filme();
        $filme->setTitulo($_POST['titulo'] ?? '');
        $filme->setAnoLancamento((int)($_POST['ano_lancamento'] ?? 0));
        
        // 2. Se for uma edição, o ID virá em um campo oculto no formulário
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $filme->setId((int)$_POST['id']);
        }
        
        // 3. Manda o serviço salvar o objeto Filme (o serviço decide se é INSERT ou UPDATE)
        $this->service->salvar($filme);
        
        // 4. Redireciona para a página de listagem
        header('Location: index.php?param=filme/listar');
        exit;
    }
}