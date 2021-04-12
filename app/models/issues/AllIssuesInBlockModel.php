<?php

namespace app\models\issues;

class AllIssuesInBlockModel
{
    private int $issueId;
    private string $caption;
    private int $status;
    private array $messageModel;

    public function __construct(int $issueId, string $caption, int $status)
    {
        $this->issueId = $issueId;
        $this->caption = $caption;
        $this->status = $status;
    }

    /**
     * @param array $messageModel
     */
    public function setMessageModel(array $messageModel): void
    {
        $this->messageModel = $messageModel;
    }

    /**
     * @return int
     */
    public function getIssueId(): int
    {
        return $this->issueId;
    }

    /**
     * @return string
     */
    public function getCaption(): string
    {
        return $this->caption;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function getMessageModel(): array
    {
        return $this->messageModel;
    }
}