<?php

namespace app\models\putInDB;

class PutterEntity
{
    private bool $stop = false;
    private ?string $error = NULL;

    private ?int $id = NULL;
    private string $question;
    private string $answer;
    private ?string $url = NULL;
    private ?string $date = NULL;

    private ?string $addTagsString = NULL;
    private ?array $addTagsArray = NULL;
    private ?array $tagsWithIdArray = NULL;

    /**
     * Разъединяет входящую информацию
     * @param array $data
     */
    public function separator(array $data): void
    {
        $this->question = $data['addQuestion'];
        $this->answer = $data['addAnswer'];
        $this->url = isset($data['addUrl']) ? $data['addUrl'] : NULL;
        $this->date = isset($data['addDate']) ? $data['addDate'] : NULL;
        $this->addTagsString = $data['addTagsString'];
        $this->addTagsArray = $data['addTagsArray'];
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

    public function setId(array $arr): void
    {
        $this->id = $arr['0']['id_main'];
    }

    /**
     * Сохранение массива тегов с их id
     * @param array $tags
     */
    public function setTagsWithId(array $tags): void
    {
        $this->tagsWithIdArray = $tags;
    }

    public function setResultEmpty(): void
    {
        $this->stop = true;
        $this->error = "Нет данных по тегам: $this->addTagsString";
    }


//  Get

    public function getId()
    {
        return $this->id;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function getAnswer(): string
    {
        return $this->answer;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

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

    public function getTagsFromDB(): array
    {
        return $this->tagsWithIdArray;
    }

}
