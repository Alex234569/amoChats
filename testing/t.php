<?php


class Foo
{
    public static function fo()
    {
        echo '123';
    }
}

class Boo
{
    public static function bo($data)
    {
        var_dump($data);
    }
}


Boo::bo(Foo::fo());

//Foo::fo();

