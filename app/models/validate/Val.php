<?php

namespace app\models\validate;


class Val
{
    private string $button;
    private ?array $tagArr;
    private ?string $tagString;
    private ?string $question;
    private ?string $answer;
    private ?string $url;

    private ?string $date;
    private bool $stop = false;
    private ?string $error = NULL;


    public function __construct(
        string $button,
        string $tagString = null,
        string $question = null,
        string $answer = null,
        string $url = null,
        string $date = null
    )
    {
        $this->button       = $button;
        $this->tagString    = $tagString;
        $this->question     = $question;
        $this->answer       = $answer;
        $this->url          = $url;
        $this->date         = $date;
    }

    /**
     * Чистим строку тегов, записываем ее в виде массива и строки
     */
    public function setTag(): void
    {
        $tagArr = explode(" ", preg_replace('/\s\s+/', ' ', trim($this->tagString)));          //  нормализация тегов: без пробелов и повторов
        $tagArr = array_values(array_unique($tagArr, SORT_STRING));
        $tagString = implode(' ', $tagArr);
        $this->tagArr = $tagArr;
        $this->tagString = $tagString;
    }

    public function setQuestion(): void
    {
        $this->question = trim($this->question);
    }

    public function setAnswer(): void
    {
        $this->answer = trim($this->answer);
    }

    public function setUrl(): void
    {

    }

    public function setDate(): void
    {

    }

    public function getAll(): array
    {
        $data = [];
        $data['button'] = $this->button;
        $data['tagArr'] = $this->tagArr;
        $data['tagString'] = $this->tagString;
        $data['question'] = $this->question;
        $data['answer'] = $this->answer;
        $data['url'] = $this->url;
        $data['date'] = $this->date;
        $data['stop'] = $this->stop;
        $data['error'] = $this->error;
        return $data;
    }
}