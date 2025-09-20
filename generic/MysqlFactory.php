<?php

namespace generic;

use dao\mysql\AvaliacaoDAO;
use dao\mysql\CategoriaDAO;
use dao\mysql\FilmeDAO;

class MysqlFactory
{
    private static ?MysqlSingleton $connection = null;

    private static function getConnection(): MysqlSingleton
    {
        if (self::$connection === null) {
            self::$connection = MysqlSingleton::getInstance();
        }
        return self::$connection;
    }
    //Cria e retorna uma instância de FilmeDAO pronta para uso.
    public static function createFilmeDAO(): FilmeDAO
    {
        $banco = self::getConnection();
        return new FilmeDAO($banco);
    }
    //Cria e retorna uma instância de CategoriaDAO pronta para uso.
    public static function createCategoriaDAO(): CategoriaDAO
    {
        $banco = self::getConnection();
        return new CategoriaDAO($banco);
    }
    //Cria e retorna uma instância de AvaliacaoDAO pronta para uso.
    public static function createAvaliacaoDAO(): AvaliacaoDAO
    {
        $banco = self::getConnection();
        return new AvaliacaoDAO($banco);
    }
}
