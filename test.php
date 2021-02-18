<?php


class Foo
{
    private string $host = 'localhost';
    private string $user = 'root';
    private string $password = 'root';
    private string $database = 'test';
    private mysqli $dbCon;
    private string $error;
    private mysqli_stmt $prepared;

    public function __construct()
    {
        $this->dbCon = mysqli_connect($this->host, $this->user, $this->password, $this->database);
    }

    public function prep($query)
    {
        if (!($this->prepared = $this->dbCon->prepare($query))) {
            $this->error = "не удалось подготовить запрос. Ошибка: " . $this->dbCon->error;
        }
    }

    public function bind($ques, $ans, $url)
    {
        if (!$this->prepared->bind_param('sss', $ques, $ans, $url)) {
            $this->error = "Не удалось привязать параметры";
        }

    }

    public function ex()
    {
        if (!$this->prepared->execute()){

            $this->error = $this->prepared->error;
            $this->error = "Не удалось выполнить запрос. Ошибка: $this->error";
        }
    }
}


// запрос
$query = 'INSERT INTO main (question, answer, url) VALUES (?, ?, ?)';

// что добавляем
$ques = 'ques1';
$ans = 'and';
$url = 'url';

// вызов методов
$foo = new Foo();



$foo->prep($query);
$foo->bind($ques, $ans, $url);
$foo->ex();


