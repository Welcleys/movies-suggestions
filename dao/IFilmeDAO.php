<?php
namespace dao;

interface IFilmeDAO{
    public function inserir($filme);
    public function atualizar($filme);
    public function listar();
    public function listarId($id);
    public function deletar($id);
    public function alterar($id,$filme);}