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

    public function no(): self
    {
        return $this;
    }

    /**
     * @return int
     */
    public function getOne(): int
    {
        return $this->one;
    }

}