<?php

class PutterStorage
{
    private ?int $PSid = NULL;
    private string $PSquestion;
    private string $PSanswer;
    private ?string $PSurl = NULL;
    private ?string $PSdate = NULL;
    private array $PStegsToSearch;
    private array $PStegsFromDB;


/**
 * отвечает за прием данных из запроса, их очистку и запись в объекты
 * @param askArray - входящий запрос
 */
    public function PSseparator(array $askArray)
    {
        $this->PSquestion = $askArray['addInfoQuestion'];
        $this->PSanswer = $askArray['addInfoAnswer'];
        $this->PSurl = isset($askArray['addInfoUrl']) ? $askArray['addInfoUrl'] : NULL;
        $this->PSdate = isset($askArray['addInfoDate']) ? $askArray['addInfoDate'] : NULL;
        $this->PStegsToSearch = explode(" ", preg_replace('/\s\s+/', ' ', $askArray['addInfoTegs']));
    }

/**
 * подготавливает массив с избыточнм количеством даных для вывода, их обработка будет осуществляться в header.php
 */
    public function PSgetAll(): array
    {
        $data = [];
        $tegsDirty = '';
        foreach ($this->PStegsFromDB as $teg){
            $tegsDirty .= $teg['teg'] . ', ';
        }
        $tegs = mb_substr($tegsDirty, -0, -2);
        $data['id'] = $this->PSid;
        $data['question'] = $this->PSquestion;
        $data['answer'] = $this->PSanswer;
        $data['url'] = $this->PSurl;
        $data['date'] = $this->PSdate;
        $data['tegs'] = $tegs;
        return $data;
    }


//  Set

    public function PSsetId(array $arr): void
    {
        $this->PSid = $arr['0']['id_main'];
    }
    public function PSsetTegsWithId(array $tegs): void
    {
        $this->PStegsFromDB = $tegs;
    }


//  Get

    public function PSgetId()
    {
        return $this->PSid;
    }

    public function PSgetQuestion()
    {
        return $this->PSquestion;
    }

    public function PSgetAnswer(): string
    {
        return $this->PSanswer;
    }

    public function PSgetUrl(): ?string
    {
        return $this->PSurl;
    }

    public function PSgetDate(): ?string
    {
        return $this->PSdate;
    }

    public function PSgetTegsToSearch(): array
    {
        return $this->PStegsToSearch;
    }

    public function PSgetTegsFromDB(): array
    {
        return $this->PStegsFromDB;
    }

}
