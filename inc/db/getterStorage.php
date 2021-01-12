<?php

class GetterStorage
{
    private string $GSdirtyTegsToSearch;
    private array $GStegsToSearch;
    private array $GSmainArrays;


/**
 * отвечает за прием данных из запроса, их очистку и запись в объекты
 * @param tegs - входящий запрос
 */
    public function GSsetTegsToSearch(string $tegs)
    {
        $cleanTegs = preg_replace('/\s\s+/', ' ', trim($tegs));
        $this->GSstringTegsToSearch = $cleanTegs;
        $this->GStegsToSearch = explode(" ", $cleanTegs);
    }

/**
 * подготавливает массив с даными для вывода, их обработка будет осуществляться в header.php
 */
    public function GSgetAll(): array
    {
        $data = [];
        $data['tegs'] = $this->GSstringTegsToSearch;
        foreach ($this->GSmainArrays as $arr) {
            $data['main'][] = $arr;
        }
        return $data;
    }


//  Set

    public function GSsetMainArrays(array $mainArr)
    {
        $this->GSmainArrays = $mainArr;
    }

    
//  Get

    public function GSgetStringTegsToSearch(): string
    {
        return $this->GSstringTegsToSearch;
    }
    public function GSgetTegsToSearch(): array
    {
        return $this->GStegsToSearch;
    }
}
