<?php


namespace app\models\issues;


use app\models\lib\DataBaseChats;

/**
 * Class GetAllBlocks для получения всх блоков
 * @package app\models\issues
 */
class GetAllBlocks
{
    private \PDO $pdo;

    public function __construct()
    {
        $dataBaseChats = new DataBaseChats();
        $this->pdo = $dataBaseChats->getPdo();
    }


    /**
     * @return array коллекции BlocksModel, если есть блоки
     */
    public function main(): array
    {
        return $this->searcher();
    }

    /**
     * Осуществляет поиск блоков по БД
     * @return array коллекции BlocksModel, если есть блоки
     */
    public function searcher(): array
    {
        $query = "SELECT * FROM blocks";
        $stmt = $this->pdo->prepare($query);

        $stmt->execute();

        $collection = [];
        while ($row = $stmt->fetch(\PDO::FETCH_LAZY)) {

            $blockModel = new BlocksModel(
                $row['blockId'],
                $row['blockName']
            );
            $collection[] = $blockModel;
        }

        return $collection;
    }
}