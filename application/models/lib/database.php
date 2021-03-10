<?php

namespace application\models\lib;

trait Database
{
    private string $host = 'localhost';    
    private string $user = 'root';
    private string $password = 'root';
    private string $database = 'chats';
    private mysqli $mysqli;




    public function Dconstruct()
    {
        $this->mysqli = new mysqli($this->host, $this->user, $this->password, $this->database);

        if ($mysqli->connect_errno) {
            echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
        
    }
 


    public function DprepareInsert()
    {
        if (!($stmt = $mysqli->prepare("INSERT INTO main (question, answer, url) VALUES (?, ?, ?)"))) {
            echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
        }
    }   

    
    public function DInsert($quest, $ans, $url)
    {
        if (!$stmt->bind_param("sss", $quest, $ans, $url)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }

    
        if (!$stmt->execute()) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
        

    }

    


}
