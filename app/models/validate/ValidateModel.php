<?php

namespace app\models\validate;

/**
 * Модель валидатора
 * Class ValidateModel
 * @package app\models\validate
 */
class ValidateModel
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

    /**
     * ValidateModel constructor.
     * @param string $button отвечает за триггер для дальнейшей идентификации действия
     */
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
     * + проверка на то, что передается именно url
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
     * @return string
     */
    public function getButton(): string
    {
        return $this->button;
    }

    /**
     * @return array|null
     */
    public function getTagArr(): ?array
    {
        return $this->tagArr;
    }

    /**
     * @return string|null
     */
    public function getTagString(): ?string
    {
        return $this->tagString;
    }

    /**
     * @return string|null
     */
    public function getQuestion(): ?string
    {
        return $this->question;
    }

    /**
     * @return string|null
     */
    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }


    /**
     * @return bool
     */
    public function isStop(): bool
    {
        return $this->stop;
    }

    /**
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error;
    }
}