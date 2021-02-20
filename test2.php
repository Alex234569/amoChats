<?php

class Foo
{
    private string $host = 'localhost';
    private string $user = 'root';
    private string $password = 'root';
    private string $database = 'test';
    private mysqli $mysqli;


    public function __construct()
    {
        $this->mysqli = mysqli_connect($this->host, $this->user, $this->password, $this->database);
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

class Boo
{
    private Foo $foo;
    private mysqli $mysqli;
    private mysqli_stmt $mysqli_stmt;

    public function __construct ()
    {
        $this->foo = new Foo();
        $this->mysqli = $this->foo->getMysqli();
    }

    public function start()
    {
        $query = 'SELECT id_main, question, answer, url FROM `main` WHERE `id_main` = ?';
        $id = 13;

        $this->mysqli_stmt = $this->mysqli->prepare($query);

        $this->mysqli_stmt->bind_param('s', $id);
        $this->mysqli_stmt->execute();
        $this->mysqli_stmt->bind_result($id_main, $question, $answer, $url);
        $this->mysqli_stmt->fetch();
        $this->mysqli_stmt->close();


        var_dump($id_main, $question, $answer, $url);

    }
}


$boo = new Boo();
$boo->start();

