<?php

namespace app\models\getFromDB;

/**
 * Хранитель для получения информации по тегам
 * Class GetterEntity
 * @package app\models\getFromDB
 */
class GetterEntity
{
    private bool $stop = false;
    private ?string $error = NULL;
    
    private ?string $getTagsString = NULL;
    private ?array $getTagsArray = NULL;
    private array $resultingArr;


    /**
     * Разъединяет входящую информацию
     * @param array $data входящие теги, в виде массива и строки
     */
    public function separator(array $data): void
    {
        $this->getTagsString = $data['getTagsString'];
        $this->getTagsArray = $data['getTagsArray'];
    }

    /**
     * Возвращает данные на отображение
     * @return array
     */
    public function getResult(): array
    {
        $data = [];
        if ($this->stop != true) {
            $data['tagsString'] = $this->getTagsString;
            $data['mainResult'] = $this->resultingArr;
            return $data;
        } else {
            $data['stop'] = $this->stop;
            $data['error'] = $this->error;
            return $data;
        }
    }


//  Set

    /**
     * Устанавливает массив данных для отображения
     * @param array $data
     */
    public function setResultArr(array $data)
    {
        $this->resultingArr = $data;
    }

    /**
     * Устанавливает стоппер
     */
    public function setResultEmpty(): void
    {
        $this->stop = true;
        $this->error = "Нет данных по тегам: $this->getTagsString";
    }
    
//  Get

    /**
     * Выдает массив тегов для поиска
     * @return array
     */
    public function getTagsToSearchArr(): array
    {
        return $this->getTagsArray;
    }
}
