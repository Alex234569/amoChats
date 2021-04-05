<?php

namespace app\models\putInDB;

use app\models\validate\ValidateModel;

/**
 * Модель для добалвения информации с тегами
 * Class PutterModel
 * @package app\models\putInDB
 */
class PutterModel
{
    private bool $stop = false;
    private ?string $error = NULL;

    private ?int $id = NULL;
    private ?string $question;
    private ?string $answer;
    private ?string $url;
    private ?string $date;

    private ?string $tagsString;
    private ?array $tagsArray;
    private ?array $tagsWithIdArray = NULL;


    public function __construct(ValidateModel $data)
    {
        $this->question     = $data->getQuestion();
        $this->answer       = $data->getAnswer();
        $this->url          = $data->getUrl();
        $this->date         = $data->getDate();
        $this->tagsString   = $data->getTagString();
        $this->tagsArray    = $data->getTagArr();
    }


    /**
     * Установка id добалвенной пары вопрос+ответ в БД
     * @param int $arr
     * @return $this
     */
    public function setId(int $arr): self
    {
        $this->id = $arr;
        return $this;
    }

    /**
     * Сохранение массива тегов с их id из ЬД
     * @param array $tags
     * @return $this
     */
    public function setTagsWithId(array $tags): self
    {
        $this->tagsWithIdArray = $tags;
        return $this;
    }

    /**
     * @return $this
     */
    public function setResultEmpty(): self
    {
        $this->stop = true;
        $this->error = "Нет данных по тегам: $this->tagsString";
        return $this;
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

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @return string
     */
    public function getAnswer(): string
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
     * @return string|null
     */
    public function getTagsString(): ?string
    {
        return $this->tagsString;
    }

    /**
     * Выдача первоначального списка тегов
     * @return array
     */
    public function getTagsToSearch(): array
    {
        return $this->tagsArray;
    }

    /**
     * @return array
     */
    public function getTagsFromDB(): array
    {
        return $this->tagsWithIdArray;
    }

}
