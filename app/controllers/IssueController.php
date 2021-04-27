<?php


namespace app\controllers;


use app\models\issues\GetAllBlocks;
use app\models\issues\AddNewBlock;
use app\models\issues\AddNewIssueInBlock;
use app\models\issues\AddNewMessage;
use app\models\issues\GetAllIssuesInBlock;
use app\views\BlocksAndIssues;

/**
 * Class IssueController для работы с страникей блоков
 * @package app\controllers
 */
class IssueController
{
    /**
     * Основной регулировщик всех кейсов по блокам.
     * Только он ловит _GET и _POST параметры и передает уже значения другим методам
     */
    public function main()
    {
    //    print_r($_GET);
    //    print_r($_POST);

        //  Если был переход в блок, то выводим все внутренности, предварительно добавив информацию при такой необходимости
        if (isset ($_GET['block'])) {
            // Если надо добавить новое обращение, то в начале добавляем его
            if (isset ($_POST['addNewIssue'])) {
                $this->addNewIssue($_GET['block'], $_POST['caption'], $_POST['text']);
            }
            // Если надо добавить новое сообщение, то добавляем
            if (isset ($_POST['addNewMessage'])) {
                $this->addNewMessage(
                    $_POST['issue'],
                    $_POST['text'],
                    $_POST['radioIssue'],
                    isset($_POST['checkboxIssue'])) ?? NULL;
            }
            // А теперь выводим все существующие обращения в блоке
            BlocksAndIssues::showAllIssues($this->getAllIssuesInBlock($_GET['block']));

        } else {
            // Если не было перехода в блок, то выводим все блоки
            // Создаем блок если надо
            if (isset($_POST['addNewBlock'])) {
                $this->addNewBlock($_POST['newBlockName']);
            }
            // Выводим
            $_GET['page'] === 'Issues' ? BlocksAndIssues::showAllBlock($this->getAllBlocks()) : NULL;
        }

    }


    /**
     * Создание нового блкоа и возвращение его id
     * @param string $data
     * @return int
     */
    public function addNewBlock(string $data): int
    {
        $addNewBlock = new AddNewBlock($data);
        return $addNewBlock->main();
    }
    // @TODO Нотификация, при добавлении блока, которое уже есть (сейчас просто произойдет слияние "втихую")


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
     * Добавление нового обращения, его привязка к блоку и добавление первичной информации
     * @param string $block к которому привяжем
     * @param string $caption заголовок обращения
     * @param string $text первичный текст обращения
     */
    public function addNewIssue(string $block, string $caption, string $text)
    {
        $getAllIssuesInBlock = new AddNewIssueInBlock($block, $caption, $text);
        $getAllIssuesInBlock->main();
        $this->addNewMessage($caption, $text, 'integrator', NULL);
    }
    // @TODO Нотификация, при добавлении обращения, которое уже есть (сейчас просто произойдет слияние "втихую")


    /**
     * Получение всех обращений с всеми сообщениями в рамках блока
     * @param string $block
     * @return array
     */
    public function getAllIssuesInBlock(string $block): array
    {
        $getAllIssuesInBlock = new GetAllIssuesInBlock($block);
        return $getAllIssuesInBlock->main();
    }


    /**
     * Добавление нового сообщения и его привязка к обращению
     * @param string $issue
     * @param string $text
     * @param string $radioIssue
     * @param string|null $checkboxIssue
     */
    public function addNewMessage(string $issue, string $text, string $radioIssue, ?string $checkboxIssue)
    {
        $addNewMessage = new AddNewMessage($issue, $text, $radioIssue, $checkboxIssue);
        $addNewMessage->main();
    }
}