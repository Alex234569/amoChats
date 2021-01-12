<?php

class InfoToDB
{
    private DB $db;
    private array $incomingData;
    private string $question;
    private string $answer;
    private ?string $url = NULL;
    private ?string $data = NULL;
    private array $newTegs;
    private array $tegId;
    private int $mainId;
    
    public function __construct()
    {
        $this->db = new DB;
    }

    public function setData($incomingData): void
    {
        $this->incomingData = $incomingData;
    }


    public function putInfoInDB()       
    {
        $this->separator();         //  разделяет входящие данные и записывает их в объекты класса
        $this->tegSearcher();   

        foreach ($this->newTegs as $k => $teg) {
            if ($teg !== $this->tegId[$k]['teg']) {
                $this->tegCreator($teg);
                $this->tegSearcher();
            }
        }
        $this->mainCreator();
        $this->compoundCreator();
    }

    private function separator(): void
    {
    //    var_dump($this->url . "\n");
        if (!empty($this->url)) {
    //        echo 'empty';
        } else {
    //        echo 'nonEmpty';
        }

        $this->question = $this->incomingData['question'];
        $this->answer   = $this->incomingData['answer'];
        $this->url      = $this->incomingData['url'];
        $this->data     = $this->incomingData['data'];
        $this->newTegs     = $this->incomingData['tegs'];


    }

    private function tegSearcher(): void 
    {
        $tegId = [];
        foreach ($this->newTegs as $k => $teg) {
            $query = "SELECT * FROM tegs WHERE teg = '$teg'";
            $result = mysqli_query($this->db->getDBCon(), $query);
            for ($tegId; $row = mysqli_fetch_assoc($result); $tegId[$k] = $row);            
        }

        $this->tegId = $tegId;
    }

    private function tegCreator($teg): void 
    {
        $query = "INSERT INTO `tegs` (`id_teg`, `teg`) VALUES (NULL, '$teg')";
        mysqli_query($this->db->getDBCon(), $query);
    }

    private function mainCreator(): void
    {

        $oneValue = '';
        $oneValue .= "(NULL, '$this->question', '$this->answer'";
        !empty($this->url) ? ($oneValue .= ", '$this->url'") : ($oneValue .= ", NULL");     //  исползую тернарный оператор что бы не менять в какие столбцы добавлять инфу
        !empty($this->data) ? ($oneValue .= ", '$this->data'") : ($oneValue .= ", NULL");
        $oneValue .= ")";

        $query = "INSERT INTO `main` (`id_main`, `question`, `answer`, `url`, `date`) VALUES  $oneValue";
        mysqli_query($this->db->getDBCon(), $query);

        $queryRes = "SELECT id_main FROM main WHERE question = '$this->question' and answer = '$this->answer'";
        $result = mysqli_query($this->db->getDBCon(), $queryRes);
        $id = mysqli_fetch_assoc($result);
        $this->mainId = $id['id_main'];
    }

    private function compoundCreator(): void
    {
        $oneValue = '';
        foreach($this->tegId as $teg) {
            $oneTegId = $teg['id_teg'];
            $oneValue .= "('$this->mainId', '$oneTegId'), ";
        }
        $oneValueFiltered = mb_substr($oneValue, -0, -2);

        $query = "INSERT INTO `compound` (`id_main`, `id_teg`) VALUES $oneValueFiltered";
        mysqli_query($this->db->getDBCon(), $query);
    }

}
