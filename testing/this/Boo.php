<?php


class Boo
{
    private int $one;
    private int $two;

    public function __construct($one, $two)
    {
        $this->one = $one;
        $this->two = $two;
    }
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

}