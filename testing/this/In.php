<?php
require_once 'Boo.php';
require_once 'Foo.php';

class In
{
    private Boo $boo;

    public function __construct()
    {
        $this->boo = new Boo(1, 2);
    }


    public function nothing()
    {
        $no = $this->boo->no();


        Foo::f($no);
    }

}


$in = new In();
$in->nothing();



