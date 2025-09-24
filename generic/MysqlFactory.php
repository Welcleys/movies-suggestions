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

    public static function createFilmeDAO(): FilmeDAO
    {
        $banco = self::getConnection();
        return new FilmeDAO($banco);
    }

    public static function createCategoriaDAO(): CategoriaDAO
    {
        $banco = self::getConnection();
        return new CategoriaDAO($banco);
    }

    public static function createAvaliacaoDAO(): AvaliacaoDAO
    {
        $banco = self::getConnection();
        return new AvaliacaoDAO($banco);
    }
}
