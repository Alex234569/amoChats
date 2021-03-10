<?php

namespace application\models\validate;

class Validate
{
    private bool $stop = false;
    private ?string $error = NULL;
    
    private string $whatToDo;    
    
    private ?string $getTegsString = NULL;
    private ?array $getTegsArray = NULL;

    private ?string $addQuestion = NULL;    
    private ?string $addAnswer = NULL;    
    private ?string $addUrl = NULL;    
    private ?string $addDate = NULL;    
    private ?string $addTegsString = NULL;    
    private ?array $addTegsArray = NULL;

    /**
     * @param $data array входе массив информации
     * @return array на выходе обычный массив данных с ключем для определения действий
     */
    public function validator(array $data): array
    {
        switch($data['button']) {
            case 'getInfo':
                $this->VgetInfo($data);
                return empty($this->error) ? $this->getGetInfo() : $this->getError();
            case 'addInfo':
                $this->VaddInfo($data);
                return empty($this->error) ? $this->getAddInfo() : $this->getError();
            default:
                $this->stop = true;
                $this->error = 'No such case to validate (/inc/validate.php)';
 
                return $this->getError();
        }
    }


    private function VgetInfo($data): void
    {
        $cleanData = trim($data['getInfo']);
        if (!empty($cleanData)){
            $tegsArr = explode(" ", preg_replace('/\s\s+/', ' ', $cleanData));          //  нормализация тегов: без пробелов и повторов
            $tegsArr = array_unique($tegsArr, SORT_STRING);
            $getTegsString = '';
            $getTegsString = implode(' ', $tegsArr);

            $this->whatToDo = 'getInfo';
            $this->getTegsString = $getTegsString;
            $this->getTegsArray = $tegsArr;
        } else {
            $this->stop = true;
            $this->error = 'Empty querry to search (/inc/validate.php)';
        }
    }


    private function VaddInfo($data): void
    {
        $cleanQuestion = trim($data['addInfoQuestion']);
        $cleanAnswer = trim($data['addInfoAnswer']);
        $cleanTegs = trim($data['addInfoTegs']);

        if (!empty($cleanQuestion) && !empty($cleanAnswer) && !empty($cleanTegs)){
            $tegsArr = explode(" ", preg_replace('/\s\s+/', ' ', $cleanTegs));          //  нормализация тегов
            $tegsArr = array_unique($tegsArr, SORT_STRING);
            $addTegsString = '';
            $addTegsString = implode(' ', $tegsArr);

            $this->whatToDo = 'addInfo';
            $this->addQuestion = $cleanQuestion;
            $this->addAnswer = $cleanAnswer;
            $this->addTegsString = $addTegsString;
            $this->addTegsArray = $tegsArr;            
            if (!empty($data['addInfoUrl'])) {
                $cleanUrl = trim($data['addInfoUrl']);
                if (filter_var($cleanUrl, FILTER_VALIDATE_URL) !=false){
                    $this->addUrl = $cleanUrl;
                } else {
                    $this->stop = true;
                    $this->error = 'Wrong URL (/inc/validate.php)';
                }
            }
            $this->addDate = isset($data['addInfoDate']) ? $data['addInfoDate'] : NULL;
        } else {
            $this->stop = true;
            $this->error = 'Empty querry to add (/inc/validate.php)';
        }
    }
    

    private function getError(): array
    {
        $data = [];
        $data['stop'] = $this->stop;
        $data['error'] = $this->error;
        return $data;
    }


    private function getGetInfo(): array
    {
        $data = [];
        $data['whatToDo'] = $this->whatToDo;
        $data['getTegsString'] = $this->getTegsString;
        $data['getTegsArray'] = $this->getTegsArray;
        return $data;
    }


    private function getAddInfo(): array
    {
        $data = [];
        $data['whatToDo'] = $this->whatToDo;
        $data['addQuestion'] = $this->addQuestion;
        $data['addAnswer'] = $this->addAnswer;
        $data['addUrl'] = $this->addUrl;
        $data['addDate'] = $this->addDate;
        $data['addTegsString'] = $this->addTegsString;
        $data['addTegsArray'] = $this->addTegsArray;
        return $data;
    }

}
