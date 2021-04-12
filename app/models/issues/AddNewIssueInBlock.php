<?php

namespace app\models\issues;

use app\models\lib\DataBaseChats;

/**
 * Class AddNewIssueInBlock для добавления ТОЛЬКО нового обращения
 * @package app\models\issues
 */
class AddNewIssueInBlock
{
    private string $block;
    private string $caption;
    private string $text;
    private ?int $issueId;

    private bool $stop = false;
    private ?string $error = NULL;

    private \PDO $pdo;

    public function __construct(string $block, string $caption, string $text)
    {
        $this->block = $block;
        $this->caption = trim($caption);
        $this->text = trim($text);
        $dataBaseChats = new DataBaseChats();
        $this->pdo = $dataBaseChats->getPdo();
    }


    /**
     * Добавляем новое обращение
     */
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


    /**
     * Проверка обращение на предмет его уже наличия
     * @param string $caption
     * @param null $stopper
     */
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

    /**
     * Добавление нового обращения
     * @param string $caption
     */
    public function addNewIssue(string $caption)
    {
        $query = 'INSERT INTO issues (caption) VALUES (?)';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($caption));

        $this->check($caption, 'added');                             //  рекурсив
    }

    /**
     * Связываение обращения с блоком
     * @param int $issueId
     */
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