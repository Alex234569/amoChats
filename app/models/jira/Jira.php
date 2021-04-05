<?php

namespace app\models\jira;

use app\models\lib\DataBaseChats;

class Jira
{
    private \PDO $pdo;

    public function __construct()
    {
        $dataBaseChats = new DataBaseChats();
        $this->pdo = $dataBaseChats->getPdo();
    }

    /**
     * Очень простая функция, однако стркутура должна быть идентична в классах с одним назначением
     * @return array
     */
    public function main(): array
    {
        return $this->searcher();
    }

    /**
     * Создают коллекцию тикетов из жиры
     * @return array
     */
    public function searcher(): array
    {
        $query = "SELECT main.question, main.answer FROM main 
             LEFT JOIN compound ON main.id_main = compound.id_main 
             LEFT JOIN tegs ON compound.id_teg = tegs.id_teg 
             WHERE tegs.teg = ?";
        $stmt = $this->pdo->prepare($query);

        $stmt->execute(array('-/'));

        $collection = [];
        while ($row = $stmt->fetch(\PDO::FETCH_LAZY)) {
            $jiraModel = new JiraModel(
                $row['question'],
                $row['answer']
            );
            $collection[] = $jiraModel;
        }

        return $collection;
    }
}