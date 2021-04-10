<?php

namespace app\controllers;

use app\models\issues\GetAllBlocks;
use app\models\issues\AddNewIssueInBlock;
use app\models\issues\GetAllIssuesInBlock;
use app\views\BlocksAndIssues;
use app\models\issues\addNewBlock;

class IssueController
{
    public function main()
    {
        print_r($_GET);
        print_r($_POST);

        if (isset ($_GET['block'])) {
            // Если надо добавить новое обращение, то в начале добавляем его
            if (isset ($_POST['addNewIssue'])) {
                $this->addNewIssue($_GET['block'], $_POST['caption'], $_POST['information']);
            }
            // А теперь выводим все существующие обращения в блоке
            BlocksAndIssues::showAllIssues($this->getAllIssuesInBlock($_GET['block']));

        } else {
            $_GET['page'] === 'Issues' ? BlocksAndIssues::showAllBlock($this->getAllBlocks()) : NULL;
            if (isset($_POST['addNewBlock'])) {
                $this->addNewBlock($_POST['newBlockName']);
            }
        }

    }

    /**
     * Добавление нового обращения и его привязка к блоку
     * @param string $block к которому привяжем
     * @param string $caption заголовок обращения
     * @param string $information первичный текст обращения
     */
    public function addNewIssue(string $block, string $caption, string $information)
    {
        $getAllIssuesInBlock = new AddNewIssueInBlock($block, $caption, $information);
        $getAllIssuesInBlock->main();
    }


    public function getAllIssuesInBlock(string $block): array
    {
        $getAllIssuesInBlock = new GetAllIssuesInBlock($block);
        return $getAllIssuesInBlock->main();
    }

    /**
     * Получения всех блоков
     * @return array
     */
    public function getAllBlocks():array
    {
        $getAllBlock = new GetAllBlocks();
        return $getAllBlock->main();
    }


    /**
     * Создание нового блкоа и возвращение его id
     * @param string $data
     * @return int
     */
    public function addNewBlock(string $data): int
    {
        $addNewBlock = new addNewBlock($data);
        return $addNewBlock->main();
    }


}