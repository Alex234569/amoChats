<?php

namespace app\models\getFromDB;

/**
 * Хранитель для получения информации по тегам
 * Class GetterEntity
 * @package app\models\getFromDB
 */
class GetterEntity extends Getter
{
    private bool $stop = false;
    private ?string $error = NULL;
    
    private ?string $GEgetTagsString = NULL;
    private ?array $GEgetTagsArray = NULL;
    private array $resultingArr;


    /**
     * Разъединяет входящую информацию
     * @param array $data входящие теги в виде массива и строки
     */
    public function setData(array $data): void
    {
        $this->GEgetTagsString = $data['getTagsString'];
        $this->GEgetTagsArray = $data['getTagsArray'];
    }

    /**
     * Возвращает данные на отображение
     * @return array
     */
    public function getResult(): array
    {
        $data = [];
        if ($this->stop != true) {
            $data['tegsString'] = $this->GEgetTagsString;
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
        $this->error = "Нет данных по тегам: $this->GEgetTagsString";
    }
    
//  Get

    /**
     * Выдает массив тегов для поиска
     * @return array
     */
    public function getTagsToSearchArr(): array
    {
        return $this->GEgetTagsArray;
    }
}
