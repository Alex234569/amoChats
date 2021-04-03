<?php

namespace app\models\validate;

/**
 * Валидация и нормализация входящей информации
 * Class Validate
 * @package app\models\validate
 */
class Validate
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

    /**
     * @param ?string $question
     * @return $this
     */
    public function setQuestion(?string $question): self
    {
        $this->question = trim($question);
        return $this;
    }

    /**
     * @param ?string $answer
     * @return $this
     */
    public function setAnswer(?string $answer): self
    {
        $this->answer = trim($answer);
        return $this;
    }

    /**
     * @param ?string $url
     * @return $this
     */
    public function setUrl(?string $url): self
    {
        $url = trim($url);
        if ((filter_var($url, FILTER_VALIDATE_URL) !=false) || (empty($url) == true)) {
            $this->url = $url;
        } else {
            $this->stop = true;
            $this->error = 'Wrong url';
        }
        return $this;
    }

    /**
     * @param ?string $date
     * @return $this
     */
    public function setDate(?string $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Вывод всех объектов класса
     * @return array
     */
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