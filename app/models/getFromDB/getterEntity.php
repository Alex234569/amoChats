<?php

namespace app\models\getFromDB;

class GetterEntity
{
    private bool $stop = false;
    private ?string $error = NULL;
    
    private ?string $GEgetTegsString = NULL;
    private ?array $GEgetTegsArray = NULL;


/**
 * отвечает за прием данных из запроса, их очистку и запись в объекты
 * @param tegs - входящий запрос
 */
    public function GEsetData(array $tegs): void
    {
        $this->GEgetTegsString = $tegs['getTegsString'];
        $this->GEgetTegsArray = $tegs['getTegsArray'];
    }

/**
 * подготавливает массив с даными для вывода, их обработка будет осуществляться в header.php
 */
    public function GEgetAll(): array
    {
        $data = [];
        if ($this->stop != true) {
            $data['tegsString'] = $this->GEgetTegsString;
            $data['mainResult'] = $this->GEmainArrays;
            return $data;
        } else {
            $data['stop'] = $this->stop;
            $data['error'] = $this->error;
            return $data;
        }
    }


//  Set

    public function GEsetResultArr(array $mainArr)
    {
        $this->GEmainArrays = $mainArr;
    }

    public function GEsetResultEmpty(): void
    {
        $this->stop = true;
        $this->error = "Нет данных по тегам: $this->GEgetTegsString";
    }
    
//  Get

    public function GEgetTegsToSearchArr(): array
    {
        return $this->GEgetTegsArray;
    }
}
