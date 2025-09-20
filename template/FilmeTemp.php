<?php

namespace template;

class FilmeTemp implements ITemplate
{
    public function cabecalho()
    {
        echo "<div> Cabecalho </div>";
    }

    public function rodape()
    {
        echo "<div> Rodapé </div>";
    }

    public function layout($caminho, $parametro = null)
    {

        $this->cabecalho();
        include $_SERVER['DOCUMENT_ROOT'] . "\\movies-suggestions" . $caminho;
        $this->rodape();
    }
}
