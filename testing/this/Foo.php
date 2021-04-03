<?php


class Foo
{
    public static function f(Boo $data)
    {
   //     var_dump($data);
        $one = $data->getOne();
        print_r($one);



    }
}