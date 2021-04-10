<?php

namespace app\models\issues;

use app\models\lib\DataBaseChats;

/**
 * Class addNewBlock для добваления нового блока
 * @package app\models\issues
 */
class addNewBlock
{
    private ?int $blockId = NULL;
    private string $blockName;

    private \PDO $pdo;

    public function __construct(string $data)
    {
        $this->blockName = trim($data);
        $dataBaseChats = new DataBaseChats();
        $this->pdo = $dataBaseChats->getPdo();
    }

    /**
     * Создание нового блока при необходимости и возвращение его id
     * @return int
     */
    public function main(): int
    {
        // Check that we dont have this blockName in DB already, add it if not
        is_null($this->check($this->blockName)) ? $this->addNewBlockName($this->blockName) : NULL;
        return $this->blockId;
    }

    /**
     * Проверка блока на наличие
     * @param string $data
     * @return int|null
     */
    public function check(string $data): ?int
    {
        $query = 'SELECT * FROM blocks WHERE blockName = (?)';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($data));

        while ($row = $stmt->fetch(\PDO::FETCH_LAZY))
        {
            $this->blockId = $row['blockId'] ?? NULL;
        }
        return($this->blockId);
    }

    /**
     * Создание нового блока
     * @param string $data
     */
    public function addNewBlockName(string $data)
    {
        $query = 'INSERT INTO blocks (blockName) VALUES (?)';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($data));
        $this->check($data);
    }

}