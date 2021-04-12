<?php


namespace app\models\issues;


use app\models\lib\DataBaseChats;

/**
 * Class GetAllIssuesInBlock для получения всей информации в рамках блока
 * @package app\models\issues
 */
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

    /**
     * @return array
     */
    public function main(): array
    {
        return $this->searcher();
    }

    /**
     * Вытаскиваю информацию о всех обращениях внутри блока
     * @return array
     */
    public function searcher(): array
    {
        $query = "SELECT * FROM issues 
            LEFT JOIN issueCompound ON issues.issueId = issueCompound.issue 
            LEFT JOIN blocks ON issueCompound.block = blocks.blockId WHERE blockName = ?";
        $stmt = $this->pdo->prepare($query);

        $stmt->execute(array($this->block));

        $collection = [];
        while ($row = $stmt->fetch(\PDO::FETCH_LAZY)) {
            $allIssuesInBlockModel = new AllIssuesInBlockModel(
                $row['issueId'],
                $row['caption'],
                $row['status'],
            );
            $this->messageSearcher($allIssuesInBlockModel);
            $collection[] = $allIssuesInBlockModel;
        }
    //    print_r($allIssuesInBlockModel);
        return $collection;
    }


    /**
     * Вытаскиваю все сообщения, котрые есть во всех обращениях, которые есть в блоке
     * @param AllIssuesInBlockModel $issue
     */
    public function messageSearcher(AllIssuesInBlockModel $issue): void
    {
        $issueId = $issue->getIssueId();
        $query = "SELECT * FROM messages 
            LEFT JOIN issueToMessageCompound ON messages.messageId = issueToMessageCompound.message 
            LEFT JOIN issues ON issueToMessageCompound.issue = issues.issueId WHERE issueId = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($issue->getIssueId()));

        $collection = [];
        while ($row = $stmt->fetch(\PDO::FETCH_LAZY)) {
            $message = new MessageModel(
                $row['text'],
                $row['from'],
                $row['date'],
            );
            $collection[] = $message;
        }
        $issue->setMessageModel($collection);
    }
}