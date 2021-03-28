<?php

namespace app\models\validate;


class Val
{
    private ?array $tagArr = NULL;
    private ?string $tagString = NULL;
    private ?string $question = NULL;
    private ?string $answer = NULL;
    private ?string $url = NULL;
    private ?string $date = NULL;


    public function __construct(array $data)
    {
        print_r($data);
        $this->tagString = $data['tag'];
        $this->question = $data['question'];
        $this->answer = $data['answer'];
        $this->url = $data['url'];
        $this->date = $data['date'];
    }

    public function setTag(?string $tag): void
    {
        $tagArr = explode(" ", preg_replace('/\s\s+/', ' ', trim($tag)));          //  нормализация тегов: без пробелов и повторов
        $tagArr = array_unique($tagArr, SORT_STRING);
        $tagString = implode(' ', $tagArr);
        $this->tagArr = $tagArr;
        $this->tagString = $tagString;
    }

    public function setQuestion(?string $question): void
    {

    }

    public function setAnswer(?string $answer): void
    {

    }

    public function setUrl(?string $url): void
    {

    }

    public function setDate(?string $date): void
    {

    }
}