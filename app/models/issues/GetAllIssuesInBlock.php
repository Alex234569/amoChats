<?php

namespace app\models\issues;

use app\models\lib\DataBaseChats;

class GetAllIssuesInBlock
{
    private string $block;
    private \PDO $pdo;

    public function __construct(string $block)
    {
        $this->block = $block;
        $dataBaseChats = new DataBaseChats();
        $this->pdo = $dataBaseChats->getPdo();
    }

    public function main(): array
    {
        return $this->searcher();
    }

    public function searcher(): array
    {
        $query = "SELECT * FROM issues 
            LEFT JOIN issueCompound ON issues.issueId = issueCompound.issue 
            LEFT JOIN blocks ON issueCompound.block = blocks.blockId WHERE blockName = ?";
        $stmt = $this->pdo->prepare($query);

        $stmt->execute(array($this->block));

        $collection = [];
        while ($row = $stmt->fetch(\PDO::FETCH_LAZY)) {
    //        print_r($row);
    //        new AllIssuesInBlockModel();
            $collection[] = $row['caption'];
        }
        return $collection;
    }
}