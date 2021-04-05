<?php


namespace app\models\getFromDB;

/**
 * Содержит результаты, найденные в БД
 * Class GetterResponseEntity
 * @package app\models\getFromDB
 */
class GetterResponseEntity
{
    private string $tagString;
    private int $idMain;
    private string $question;
    private string $answer;
    private ?string $url;
    private ?string $date;


    /**
     * @param string $tagString
     * @return $this
     */
    public function setTagString(string $tagString): self
    {
        $this->tagString = $tagString;
        return $this;
    }

    /**
     * @param int $idMain
     * @return $this
     */
    public function setIdMain(int $idMain): self
    {
        $this->idMain = $idMain;
        return $this;
    }

    /**
     * @param string $question
     * @return $this
     */
    public function setQuestion(string $question): self
    {
        $this->question = $question;
        return $this;
    }

    /**
     * @param string $answer
     * @return $this
     */
    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;
        return $this;
    }

    /**
     * @param string|null $url
     * @return $this
     */
    public function setUrl(?string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param string|null $date
     * @return $this
     */
    public function setDate(?string $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getTagString(): string
    {
        return $this->tagString;
    }

    /**
     * @return int
     */
    public function getIdMain(): int
    {
        return $this->idMain;
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

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }
}