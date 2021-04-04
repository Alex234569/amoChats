<?php

class Foo
{

    public int $one;
    public int $two;

    public function __construct($one, $two)
    {
        $this->one = $one;
        $this->two = $two;
    }

    public function __destruct() {
        return $this;
    }

}

class Boo
{

    public static function toDo()
    {
        $one = new Foo(1, 2);
        return $one;
    }
}

$boo = new Boo();
$res = $boo->toDo();

print_r($res);

foreach ($res as $r){
    echo $r;
}

