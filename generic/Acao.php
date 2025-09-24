<?php
namespace generic;

class Acao{
    public string $classe;
    public string $metodo;
    private array $params;

    public function __construct(string $classe, string $metodo, array $params = []){
        $this->classe = "controller\\" . ucfirst($classe) . "Controller";
        $this->metodo = $metodo;
        $this->params = $params;
    }

    public function executar(){
        if (!class_exists($this->classe)) {
            throw new \Exception("Erro: Controller '{$this->classe}' não encontrado.");
        }

        $obj = new $this->classe();

        if (!method_exists($obj, $this->metodo)) {
            throw new \Exception("Erro: Método '{$this->metodo}' não encontrado no controller '{$this->classe}'.");
        }
        
        call_user_func_array([$obj, $this->metodo], $this->params);
    }
}