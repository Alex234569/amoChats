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
        $this->
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