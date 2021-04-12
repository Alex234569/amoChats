<?php


namespace app\models\issues;


use app\models\lib\DataBaseChats;

/**
 * Class AddNewMessage для добавления нового сообщения и связывание его с обращением
 * @package app\models\issues
 */
class AddNewMessage
{
    private string $issue;
    private string $text;
    private string $radioIssue;
    private ?string $checkboxIssue;

    private \PDO $pdo;

    public function __construct(
        string $issue,
        string $text,
        string $radioIssue,
        ?string $checkboxIssue
    ) {
        $this->issue = $issue;
        $this->text = $text;
        $this->radioIssue = ($radioIssue === 'integrator') ? 0 : 1;
        $this->checkboxIssue = $checkboxIssue;

        $dataBaseChats = new DataBaseChats();
        $this->pdo = $dataBaseChats->getPdo();
    }

    /**
     * регулировщик, закрывает обращение, если передан соответствующий парамтер
     */
    public function main()
    {
        if (!empty($this->checkboxIssue)) {
            $this->issueClose($this->issueSearcher());
        }
        $this->compoundAdjuster($this->issueSearcher(), $this->addNewMessage());
    }

    /**
     * Добавляю новое сообщение
     * @return int id добавленного сообщения
     */
    public function addNewMessage(): int
    {
        $query = 'INSERT INTO messages (text, `from`, date) VALUES (?, ?, ?)';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($this->text, $this->radioIssue, date('d-m-Y')));
        return $this->pdo->lastInsertId();
    }

    /**
     * Поиск id модального блока
     * @return int
     */
    public function issueSearcher(): int
    {
        $query = 'SELECT * FROM issues WHERE caption = ?';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($this->issue));
        $row = $stmt->fetch(\PDO::FETCH_LAZY);
        return $row['issueId'];
    }

    /**
     * Добавление связи обращения и сообщения
     * @param int $issueId
     * @param int $messageId
     */
    public function compoundAdjuster(int $issueId, int $messageId): void
    {
        $query = 'INSERT INTO issueToMessageCompound (issue, message) VALUES (?, ?)';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($issueId, $messageId));
    }

    /**
     * Закрытие обращение, путем передачи 1 в колонку "статус"
     * @param int $issueId
     */
    public function issueClose(int $issueId): void
    {
        $query = 'UPDATE issues SET status = ? WHERE issueId = ?';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array(1, $issueId));
    }
}