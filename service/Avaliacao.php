<?php
namespace service;

class Avaliacao {
    private ?int $id;
    private ?int $filme_id;
    private ?int $categoria_id;
    private ?int $nota;
    private ?string $filme_titulo;
    private ?string $categoria_nome;

    public function __construct() {
        $this->id = null;
        $this->filme_id = null;
        $this->categoria_id = null;
        $this->nota = null;
        $this->filme_titulo = null;
        $this->categoria_nome = null;
    }

    public function getId(): ?int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }

    public function getFilmeId(): ?int { return $this->filme_id; }
    public function setFilmeId(int $filme_id): void { $this->filme_id = $filme_id; }

    public function getCategoriaId(): ?int { return $this->categoria_id; }
    public function setCategoriaId(int $categoria_id): void { $this->categoria_id = $categoria_id; }

    public function getNota(): ?int { return $this->nota; }
    public function setNota(int $nota): void { $this->nota = $nota; }

    public function getFilmeTitulo(): ?string { return $this->filme_titulo; }
    public function setFilmeTitulo(string $titulo): void { $this->filme_titulo = $titulo; }

    public function getCategoriaNome(): ?string { return $this->categoria_nome; }
    public function setCategoriaNome(string $nome): void { $this->categoria_nome = $nome; }
}