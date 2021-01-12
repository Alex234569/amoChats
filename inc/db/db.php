<?php

trait DB 
{
    private string $host = 'localhost';    
    private string $user = 'root';
    private string $password = 'root';
    private string $database = 'chats';
    private mysqli $dbCon;
    

    public function DBconstruct()
    {
        $this->dbCon = mysqli_connect($this->host, $this->user, $this->password, $this->database);
    }

    public function DBdestruct()
    {
        mysqli_close($this->dbCon);
    }


/**
 * Запрос на получении информации из БД
 * @param query - готовая строка запроса
 */
    public function clientGet ($query): array
    {
        $results = mysqli_query($this->dbCon, $query);
        for ($data = []; $row = mysqli_fetch_assoc($results); $data[] = $row);
        return($data);
    }


/**
 * Запрос на добавление информации в БД
 * @param query - готовая строка запроса
 */    
    public function clientAdd ($query): void
    {
        $res = mysqli_query($this->dbCon, $query);
        if ($res != true) {
            echo "\n" . 'ALARM: не выполнен запрос на добалвение в БД';
            die;                                                        //  нужно что бы не появлялся бесконечный цикл
        }
    }
}
