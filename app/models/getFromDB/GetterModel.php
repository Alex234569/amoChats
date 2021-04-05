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
    
    private ?string $tagsString;
    private ?array $getTagsArray;
    private array $collection;


    /**
     * GetterModel constructor.
     * @param ValidateModel $data
     */
    public function __construct(ValidateModel $data)
    {
        $this->tagsString = $data->getTagString();
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


//  Set

    /**
     * @param array $collection
     * @return $this
     */
    public function setCollection(array $collection): self
    {
        $this->collection = $collection;
        return $this;
    }

    /**
     * Устанавливает стоппер
     * @return $this
     */
    public function setResultEmpty(): self
    {
        $this->stop = true;
        $this->error = "Нет данных по тегам: $this->tagsString";
        return $this;
    }
    
//  Get

    /**
     * @return array
     */
    public function getCollection(): array
    {
        return $this->collection;
    }

    /**
     * Выдает массив тегов для поиска
     * @return array
     */
    public function getTagsToSearchArr(): array
    {
        return $this->getTagsArray;
    }

    /**
     * @return string|null
     */
    public function getTagsString(): ?string
    {
        return $this->tagsString;
    }
}
