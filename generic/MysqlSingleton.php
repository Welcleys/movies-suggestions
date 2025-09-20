<?php
namespace generic;

use PDO;
use PDOException;

class  MysqlSingleton
{

    private static ?MysqlSingleton $instance = null;

    private string $dns;
    private string $username;
    private string $password;
    private array $options;

    private ?PDO $connection = null;
    private ?PDO $pdo = null;

    private function __construct()
    {

        $this->dns = "mysql:host=localhost;dbname=sugestao_filmes;charset=utf8";
        $this->username = "root";
        $this->password = "";
        $this->options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
    }

    public static function getInstance(): self
    {

        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function connect(): PDO
    {

        if ($this->pdo === null) {
            $this->pdo = new PDO($this->dns, $this->username, $this->password, $this->options);
        }
        return $this->pdo;
    }

    public function query(string $sql)
    {

        $pdo = $this->connect();
        return $pdo->query($sql);
    }

    public function prepared(string $sql, array $params = [])
    {

        $pdo = $this->connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function executeNonQuery(string $sql, array $params = []): int
    {
        $stmt = $this->prepared($sql, $params);
        return $stmt->rowCount();
    }
}
