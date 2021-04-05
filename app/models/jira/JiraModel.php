<?php

namespace app\models\jira;

class JiraModel
{
    private string $question;
    private string $answer;

    public function __construct($question, $answer)
    {
        $this->question = $question;
        $this->answer = $answer;
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }
}