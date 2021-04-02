<?php

namespace app\models\lib;

class DataBaseChats
{
    private string $host = 'localhost';
    private string $user = 'root';
    private string $password = 'root';
    private string $database = 'chats';
    private string $charset = 'utf8';
    private \PDO $pdo;


    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->database;charset=$this->charset";
        $opt = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new \PDO($dsn, $this->user, $this->password, $opt);
    }

    public function __destruct()
    {

    }

    /**
     * Получение объекста \PDO
     * @return false|\pdo
     */
    public function getMysqli()
    {
        return $this->pdo;
    }
}
