<?php

class MainData
{
    public string $MDquestion;
    private string $MDanswer;
    private ?string $MDurl = NULL;
    private ?string $MDdate = NULL;


    public function MDgetQuestion(): string
    {
        return $this->MDquestion;
    }

    public function MDgetAnswer(): string
    {
        return $this->MDanswer;
    }

    public function MDgetUrl(): string
    {
        return $this->MDurl;
    }

    public function MDgetDate(): string
    {
        return $this->MDdate;
    }


    public function MDsetQuestion($question): void 
    {
        $this->MDquestion = $question;
    //    print_r($this->MDquestion);
    }

    public function MDsetAnswer($answer): void 
    {
        $this->MDanswer = $answer;
    }

    public function MDsetUrl($url): void 
    {
        $this->MDurl = $url;
    }

    public function MDsetDate($date): void 
    {
        $this->MDdate = $date;
    }
}
