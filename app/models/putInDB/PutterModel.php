<?php

namespace app\models\putInDB;

use app\models\validate\Validate;

/**
 * Хранитель для добалвения информации с тегами
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

    private ?string $addTagsString;
    private ?array $addTagsArray;
    private ?array $tagsWithIdArray = NULL;


    public function __construct(Validate $data)
    {
        $this->question = $data->getQuestion();
        $this->answer = $data->getAnswer();
        $this->url = $data->getUrl();
        $this->date = $data->getDate();
        $this->addTagsString = $data->getTagString();
        $this->addTagsArray = $data->getTagArr();
    }

/**
 * подготавливает массив с избыточнм количеством даных для вывода, их обработка будет осуществляться в header.php
 */
    public function getAll(): array
    {
        $data = [];
        if ($this->stop != true) {
            $data['id'] = $this->id;
            $data['question'] = $this->question;
            $data['answer'] = $this->answer;
            $data['url'] = $this->url;
            $data['date'] = $this->date;
            $data['tags'] = $this->addTagsString;
            return $data;
        } else {
            $data['stop'] = $this->stop;
            $data['error'] = $this->error;
            return $data;
        }
       
    }


//  Set

    /** Установка id добалвенной пары вопрос+ответ в БД
     * @param int $arr
     */
    public function setId(int $arr): void
    {
        $this->id = $arr;
    }

    /**
     * Сохранение массива тегов с их id из ЬД
     * @param array $tags
     */
    public function setTagsWithId(array $tags): void
    {
        $this->tagsWithIdArray = $tags;
    }

    /**
     *
     */
    public function setResultEmpty(): void
    {
        $this->stop = true;
        $this->error = "Нет данных по тегам: $this->addTagsString";
    }


//  Get

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getQuestion()
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
     * Выдача первоначального списка тегов
     * @return array
     */
    public function getTagsToSearch(): array
    {
        return $this->addTagsArray;
    }

    /**
     * @return array
     */
    public function getTagsFromDB(): array
    {
        return $this->tagsWithIdArray;
    }

}
