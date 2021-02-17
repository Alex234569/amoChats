<?php
/*
$mysqli = new mysqli("localhost", "root", "root", "test");

                if ($mysqli->connect_errno) {
                    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                }


if (!($stmt = $mysqli->prepare("INSERT INTO main (question, answer, url) VALUES (?, ?, ?)"))) {
    echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
}


$quest = 'quest';
$ans = 'ans';
$url = 'url';
if (!$stmt->bind_param("sss", $quest, $ans, $url)) {
    echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
}



if (!$stmt->execute()) {
    echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
}
*/

class Foo
{
    private string $host = 'localhost';
    private string $user = 'root';
    private string $password = 'root';
    private string $database = 'test';
    private mysqli $dbCon;

    public function __construct()
    {
        $this->dbCon = mysqli_connect($this->host, $this->user, $this->password, $this->database);
    }

    public function onePrep()
    {
        if (!($stmt = $mysqli->prepare("INSERT INTO main (question, answer, url) VALUES (?, ?, ?)"))) {
            echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
        }
    }

    public function oneBind()
    {
        $quest = 'quest';
        $ans = 'ans';
        $url = 'url';
        if (!$stmt->bind_param("sss", $quest, $ans, $url)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
    }

    public function oneExe()
    {
        if (!$stmt->execute()) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
    }
}

$foo = new Foo();








