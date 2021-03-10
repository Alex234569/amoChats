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
    private ?string $error = NULL;

    public function __construct ()
    {
        $this->foo = new Foo();
        $this->mysqli = $this->foo->getMysqli();
    }

    public function start()
    {
        $query = 'INSERT INTO main (question, answer, url) VALUES (?, ?, ?)';
        $ques = 'ques1';
        $ans = 'ans';
        $url = 'url';


        $this->mysqli_stmt = $this->mysqli->prepare($query);
        $this->mysqli_stmt->bind_param('sss', $ques, $ans, $url);
        if (!$this->mysqli_stmt->execute()){
            $this->error = $this->mysqli_stmt->error . '. file';
        }
        $this->mysqli_stmt->close();
    }
}


$boo = new Boo();
$boo->start();

