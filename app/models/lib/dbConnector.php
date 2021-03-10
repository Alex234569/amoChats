<?php

namespace app\models\lib;

class DBConnector
{
    private string $host = 'localhost';
    private string $user = 'root';
    private string $password = 'root';
    private string $database = 'chats';
    private mysqli $dbCon;
    private string $prepared;

    public function __constuct()
    {
        $this->dbCon = mysqli_connect($this->host, $this->user, $this->password, $this->database);
    }

    public function __destruct()
    {
        mysqli_close($this->dbCon);
    }
}
