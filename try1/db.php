<?php


class DB {
    private string $host = 'localhost';    
    private string $user = 'root';
    private string $password = 'root';
    private string $database = 'chats';
    private mysqli $dbCon;
    
    
    public function __construct()
    {
        $this->dbCon = mysqli_connect($this->host, $this->user, $this->password, $this->database);
    }

    public function __destruct()
    {
        mysqli_close($this->dbCon);
    }

    public function getDBCon(): mysqli
    {
        return $this->dbCon;
    }

    public function client ($query): array
    {
        $results = mysqli_query($this->dbCon, $query);
        for ($data = []; $row = mysqli_fetch_assoc($results); $data[] = $row);
        return($data);
    }
}










