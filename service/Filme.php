<?php
namespace service;

class Filme {
    private ?int $id;
    private ?string $titulo;
    private ?int $ano_lancamento;

    public function __construct() {
        $this->id = null;
        $this->titulo = null;
        $this->ano_lancamento = null;
    }

    public function getId(): ?int {
        return $this->id;
    }
    public function getTitulo(): ?string {
        return $this->titulo;
    }
    public function getAnoLancamento(): ?int {
        return $this->ano_lancamento;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }
    public function setTitulo(string $titulo): void {
        $this->titulo = $titulo;
    }
    public function setAnoLancamento(int $ano_lancamento): void {
        $this->ano_lancamento = $ano_lancamento;
    }
}