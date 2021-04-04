<?php

namespace app\models\getFromDB;

use app\models\validate\ValidateModel;

/**
 * Модель для получения информации по тегам
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



    public function __construct(ValidateModel $data)
    {
        $this->getTagsString = $data->getTagString();
        $this->getTagsArray  = $data->getTagArr();
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
     * @return array
     */
    public function getResultingArr(): array
    {
        return $this->resultingArr;
    }

    /**
     * Возвращает данные на отображение
     * @return array
     */
/*    public function getResult(): array
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
*/

//  Set

    /**
     * Устанавливает массив данных для отображения
     * @param array $data
     * @return $this
     */
    public function setResultArr(array $data): self
    {
        $this->resultingArr = $data;
        return $this;
    }

    /**
     * Устанавливает стоппер
     * @return $this
     */
    public function setResultEmpty(): self
    {
        $this->stop = true;
        $this->error = "Нет данных по тегам: $this->getTagsString";
        return $this;
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
