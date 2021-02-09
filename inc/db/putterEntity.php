<?php

class PutterEntity
{
    private bool $stop = false;
    private ?string $error = NULL;

    private ?int $PEid = NULL;
    private string $PEquestion;
    private string $PEanswer;
    private ?string $PEurl = NULL;
    private ?string $PEdate = NULL;

    private ?string $PEaddTegsString = NULL;
    private ?array $PEaddTegsArray = NULL;
    private ?array $PEtegsWithIdArray = NULL;

/**
 * отвечает за прием данных из запроса, их очистку и запись в объекты
 * @param askArray - входящий запрос
 */
    public function PEseparator(array $data)
    {
        $this->PEquestion = $data['addQuestion'];
        $this->PEanswer = $data['addAnswer'];
        $this->PEurl = isset($data['addUrl']) ? $data['addUrl'] : NULL;
        $this->PEdate = isset($data['addDate']) ? $data['addDate'] : NULL;
        $this->PEaddTegsString = $data['addTegsString'];
        $this->PEaddTegsArray = $data['addTegsArray'];
    }

/**
 * подготавливает массив с избыточнм количеством даных для вывода, их обработка будет осуществляться в header.php
 */
    public function PEgetAll(): array
    {
        $data = [];
        $data = [];
        if ($this->stop != true) {
            $data['id'] = $this->PEid;
            $data['question'] = $this->PEquestion;
            $data['answer'] = $this->PEanswer;
            $data['url'] = $this->PEurl;
            $data['date'] = $this->PEdate;
            $data['tegs'] = $this->PEaddTegsString;
            return $data;
        } else {
            $data['stop'] = $this->stop;
            $data['error'] = $this->error;
            return $data;
        }
       
    }


//  Set

    public function PEsetId(array $arr): void
    {
        $this->PEid = $arr['0']['id_main'];
    }
    public function PEsetTegsWithId(array $tegs): void
    {
        $this->PEtegsWithIdArray = $tegs;
    }

    public function PEsetResultEmpty(): void
    {
        $this->stop = true;
        $this->error = "Нет данных по тегам: $this->PEgetTegsString";
    }


//  Get

    public function PEgetId()
    {
        return $this->PEid;
    }

    public function PEgetQuestion()
    {
        return $this->PEquestion;
    }

    public function PEgetAnswer(): string
    {
        return $this->PEanswer;
    }

    public function PEgetUrl(): ?string
    {
        return $this->PEurl;
    }

    public function PEgetDate(): ?string
    {
        return $this->PEdate;
    }

    public function PEgetTegsToSearch(): array
    {
        return $this->PEaddTegsArray;
    }

    public function PEgetTegsFromDB(): array
    {
        return $this->PEtegsWithIdArray;
    }

}
