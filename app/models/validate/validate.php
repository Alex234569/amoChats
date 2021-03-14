<?php

namespace app\models\validate;

class Validate
{
    private bool $stop = false;
    private ?string $error = NULL;
    
    private string $whatToDo;    
    
    private ?string $getTagsString = NULL;
    private ?array $getTagsArray = NULL;

    private ?string $addQuestion = NULL;    
    private ?string $addAnswer = NULL;    
    private ?string $addUrl = NULL;    
    private ?string $addDate = NULL;    
    private ?string $addTagsString = NULL;
    private ?array $addTagsArray = NULL;

    /**
     * @param array $data
     * @return array на выходе обычный массив данных с ключем для определения действий
     */
    public function validator(array $data): array
    {
        switch($data['button']) {
            case 'getInfo':
                $this->getInfo($data);
                return empty($this->error) ? $this->getGetInfo() : $this->getError();
            case 'addInfo':
                $this->addInfo($data);
                return empty($this->error) ? $this->getAddInfo() : $this->getError();
            default:
                $this->stop = true;
                $this->error = 'No such case to validate (/inc/validate.php)';
 
                return $this->getError();
        }
    }

    /**
     * Подготовка данных для запроса информации из БД по тегам
     * @param array $data
     */
    private function getInfo(array $data): void
    {
        $cleanData = trim($data['getInfo']);
        if (!empty($cleanData)){
            $tagsArr = explode(" ", preg_replace('/\s\s+/', ' ', $cleanData));          //  нормализация тегов: без пробелов и повторов
            $tagsArr = array_unique($tagsArr, SORT_STRING);
            $getTagsString = implode(' ', $tagsArr);

            $this->whatToDo = 'getInfo';
            $this->getTagsString = $getTagsString;
            $this->getTagsArray = $tagsArr;
        } else {
            $this->stop = true;
            $this->error = 'Empty querry to search (/inc/validate.php)';
        }
    }

    /**
     * Подготовка данных для добавления их в БД
     * @param array $data
     */
    private function addInfo(array $data): void
    {
        $cleanQuestion = trim($data['addInfoQuestion']);
        $cleanAnswer = trim($data['addInfoAnswer']);
        $cleanTags = trim($data['addInfoTags']);

        if (!empty($cleanQuestion) && !empty($cleanAnswer) && !empty($cleanTags)){
            $tagsArr = explode(" ", preg_replace('/\s\s+/', ' ', $cleanTags));          //  нормализация тегов
            $tagsArr = array_unique($tagsArr, SORT_STRING);
            $addTagsString = implode(' ', $tagsArr);

            $this->whatToDo = 'addInfo';
            $this->addQuestion = $cleanQuestion;
            $this->addAnswer = $cleanAnswer;
            $this->addTagsString = $addTagsString;
            $this->addTagsArray = $tagsArr;
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
            $this->error = 'Empty query to add (/inc/validate.php)';
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
        $data['getTagsString'] = $this->getTagsString;
        $data['getTagsArray'] = $this->getTagsArray;
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
        $data['addTagsString'] = $this->addTagsString;
        $data['addTagsArray'] = $this->addTagsArray;
        return $data;
    }

}
