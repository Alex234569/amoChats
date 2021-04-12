<?php


namespace app\models\issues;


class MessageModel
{
    private string $text;
    private int $from;
    private string $date;

    public function __construct(string $text, int $from, string $date)
    {
        $this->text = $text;
        $this->from = $from;
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return int
     */
    public function getFrom(): int
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }
}