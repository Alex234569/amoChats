<?php

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
        $query = 'SELECT main.question, main.answer, main.url, main.date FROM main 
            LEFT JOIN compound ON main.id_main = compound.id_main 
            LEFT JOIN tegs ON compound.id_teg = tegs.id_teg 
            WHERE tegs.teg = ?';
/*
        $query = 'SELECT main.question, main.answer, main.url, main.date FROM main 
            LEFT JOIN compound ON main.id_main = compound.id_main 
            LEFT JOIN tegs ON compound.id_teg = tegs.id_teg 
            WHERE tegs.teg IN ("животное", "говорить") 
            GROUP BY main.id_main HAVING (COUNT(*) = 2)';
*/

        $id = 'asd';

        $this->mysqli_stmt = $this->mysqli->prepare($query);

        $this->mysqli_stmt->bind_param('s', $id);
        $this->mysqli_stmt->execute();
        $this->mysqli_stmt->bind_result($id_main, $question, $answer, $url);
        $this->mysqli_stmt->fetch();
        $this->mysqli_stmt->close();


        var_dump($id_main, $question, $answer, $url);

    }
}

