<?php

namespace app\models\issues;

use app\models\lib\DataBaseChats;

class AddNewIssueInBlock
{
    private string $block;
    private string $caption;
    private string $information;
    private ?int $issueId;

    private bool $stop = false;
    private ?string $error = NULL;

    private \PDO $pdo;

    public function __construct(string $block, string $caption, string $information)
    {
        $this->block = $block;
        $this->caption = trim($caption);
        $this->information = trim($information);
        $dataBaseChats = new DataBaseChats();
        $this->pdo = $dataBaseChats->getPdo();
    }

    public function main()
    {
        $this->check($this->caption);

    /*    } else {
            $this->stop = true;
            $this->error = 'Уже есть обращение с таким названием';
            echo 'Уже есть обращение с таким названием';
        }
    */
    }



    private function check(string $caption, $stopper = NULL): void
    {
        $query = "SELECT * FROM issues WHERE caption = (?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($caption));
        $row = $stmt->fetch(\PDO::FETCH_LAZY);

        if ($row == false) {                                                                  //  если пары нет, то $response пустой
            $this->addNewIssue($caption);                                                //      и тогда вызываем f() для добавления пары
        } elseif ($stopper !== NULL) {                                                        //  в случае если данная f() вызывается из mainAdjuster(), то выполняется это условие
            $this->compoundAdjuster($row['issueId']);                                                              //      и вызываем f() связыватель teg & main
        }
    }

    public function addNewIssue(string $caption)
    {
        $query = 'INSERT INTO issues (caption, `from`, date, message) VALUES (?, ?, ?, ?)';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($caption, 0, date('d-m-Y'), $this->information));

        $this->check($caption, 'added');                             //  рекурсив
    }

    private function compoundAdjuster(int $issueId): void
    {
        // для начала узнаем id блкоа
        $query = "SELECT * FROM blocks WHERE blockName = (?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($this->block));
        $row = $stmt->fetch(\PDO::FETCH_LAZY);
        $blockId = $row['blockId'];

        // А теперь создаем связь блока и обращения
        $query = "INSERT INTO issueCompound (block, issue) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($blockId, $issueId));
    }
}