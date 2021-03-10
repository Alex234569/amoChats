<?php

namespace app\models\lib;

class DBConnector
{
    private string $host = 'localhost';
    private string $user = 'root';
    private string $password = 'root';
    private string $database = 'chats';
    private mysqli $mysqli;


    public function __construct()
    {
        $this->mysqli = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        print_r($mysqli);
    }

    public function __destruct()
    {
        mysqli_close($this->mysqli);
    }

    /**
     * @return false|mysqli
     */
    public function getMysqli()
    {
        return $this->mysqli;
    }
}
