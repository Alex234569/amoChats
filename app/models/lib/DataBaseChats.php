<?php

namespace app\models\lib;

class DataBaseChats
{
    private string $host = 'localhost';
    private string $user = 'root';
    private string $password = 'root';
    private string $database = 'chats';
    private \mysqli $mysqli;


    public function __construct()
    {
        $this->mysqli = new \mysqli($this->host, $this->user, $this->password, $this->database);
    }

    public function __destruct()
    {
        mysqli_close($this->mysqli);
    }

    /**
     * Получение объекста \Mysqli
     * @return false|\mysqli
     */
    public function getMysqli()
    {
        return $this->mysqli;
    }
}
