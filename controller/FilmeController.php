<?php
namespace controller;

use service\FilmeService;
use service\Filme;
use template\FilmeTemp;

class FilmeController {

    private FilmeService $service;
    private FilmeTemp $template; // ADICIONADO: Propriedade para guardar nosso template

    /**
     * O construtor é chamado automaticamente quando o Controller é criado.
     * Ele prepara as dependências que a classe irá usar.
     */
    public function __construct() {
        $this->service = new FilmeService();
        $this->template = new FilmeTemp(); // ADICIONADO: Criamos o objeto que vai renderizar as páginas
    }
    
    /**
     * Ação: LISTAR
     * Busca todos os filmes através do serviço e carrega a view de listagem.
     */
    public function listar() {
        // O service nos retorna um array de objetos 'Filme'
        $listaDeFilmes = $this->service->listarTodos();
        
        // O require_once torna a variável $listaDeFilmes disponível dentro da view
        $this->template->layout('listar.php', ['listaDeFilmes' => $listaDeFilmes]);
    }

    /**
     * Ação: EXCLUIR
     * Recebe um ID da URL, manda o serviço deletar e redireciona para a lista.
     */
    public function excluir(int $id) {
        $this->service->deletar($id);
        
        // É uma boa prática redirecionar após uma ação de POST, PUT ou DELETE
        header("Location: " . url("filme/listar"));
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
        $this->template->layout('form.php', ['filme' => $filme]);
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
        
        // Inicia a sessão e define a mensagem de feedback
        session_start();
        $_SESSION["mensagem"] = "Filme salvo com sucesso!";

        // 4. Redireciona para a página de listagem
        header("Location: " . BASE_URL . "filme/listar");
        exit;
    }
}