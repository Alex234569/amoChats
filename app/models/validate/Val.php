<?php

namespace app\models\validate;


class Val
{
    private string $button;
    private ?array $tagArr = NULL;
    private ?string $tagString = NULL;
    private ?string $question = NULL;
    private ?string $answer = NULL;
    private ?string $url = NULL;

    private ?string $date;
    private bool $stop = false;
    private ?string $error = NULL;


    public function __construct(string $button)
    {
        $this->button = $button;
    }

    /**
     * Чистим строку тегов, записываем ее в виде массива и строки
     * @param string $tag
     * @return $this
     */
    public function setTag(string $tag): self
    {
        $tagArr = explode(" ", preg_replace('/\s\s+/', ' ', trim($tag)));
        $tagArr = array_values(array_unique($tagArr, SORT_STRING));
        $tagString = implode(' ', $tagArr);
        $this->tagArr = $tagArr;
        $this->tagString = $tagString;
        return $this;
    }

    public function setQuestion($question): self
    {
        $this->question = trim($question);
        return $this;
    }

    public function setAnswer($answer): self
    {
        $this->answer = trim($answer);
        return $this;
    }

    public function setUrl($url): self
    {
        $this->url = $url;
        return $this;
    }

    public function setDate($date): self
    {
        $this->date = $date;
        return $this;
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