<?php

namespace app\models\getFromDB;

use app\models\validate\Validate;

/**
 * Хранитель для получения информации по тегам
 * Class GetterModel
 * @package app\models\getFromDB
 */
class GetterModel
{
    private bool $stop = false;
    private ?string $error = NULL;
    
    private ?string $getTagsString;
    private ?array $getTagsArray;
    private array $resultingArr;



    public function __construct(Validate $data)
    {
        $this->getTagsString = $data->getTagString();
        $this->getTagsArray = $data->getTagArr();
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
