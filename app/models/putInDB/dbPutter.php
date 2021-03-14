<?php

namespace app\models\putInDB;

use app\models\lib\DataBaseChats;

class DBPutter
{
    private DataBaseChats $dataBaseChats;
    private PutterEntity $putterEntity;
    private \mysqli $mysqli;
    private \mysqli_stmt $mysqli_stmt;

    public function __construct()
    {
        $this->putterEntity = new PutterEntity();
        $this->dataBaseChats = new DataBaseChats();
        $this->mysqli = $this->dataBaseChats->getMysqli();
    }

    /**
     * Основая функция контролирующая отправку информации в ДБ
     * @param array $data
     * @return array
     */
    public function mainPutter(array $data): array
    {
        $this->putterEntity->separator($data);
    echo "<pre>";
    print_r($this->putterEntity);

        $this->tegSearcher();
    /*
        $question = $this->putterEntity->getQuestion();
        $answer = $this->putterEntity->getAnswer();
        $this->mainSearcher($question, $answer);
*/

        return $this->putterEntity->getAll();
    }


    /**
     * Проверяет наличие входящих тегов в ДБ
     */
    private function tegSearcher(): void
    {
        $tagsToSearchArr = $this->putterEntity->getTagsToSearch();       //  теги, которые пришли из поиска

        $tagsAmount = count($tagsToSearchArr);

        $numberParams = '';
        for ($n = 0; $n < $tagsAmount; $n++){
            $numberParams .= '?) OR teg = (';
        }
        $numberParams = mb_substr($numberParams, -0, -12);

        $query = "SELECT * FROM tegs WHERE teg = ($numberParams)";

        $this->mysqli_stmt = $this->mysqli->prepare($query);

        switch ($tagsAmount){
            case 1:
                $this->mysqli_stmt->bind_param('s', $tagsToSearchArr[0]);
                break;
            case 2:
                $this->mysqli_stmt->bind_param('ss', $tagsToSearchArr[0], $tagsToSearchArr[1]);
                break;
            case 3:
                $this->mysqli_stmt->bind_param('sss', $tagsToSearchArr[0], $tagsToSearchArr[1], $tagsToSearchArr[2]);
                break;
            case 4:
                $this->mysqli_stmt->bind_param('ssss', $tagsToSearchArr[0], $tagsToSearchArr[1], $tagsToSearchArr[2], $tagsToSearchArr[3]);
                break;
            case 5:
                $this->mysqli_stmt->bind_param('sssss', $tagsToSearchArr[0], $tagsToSearchArr[1], $tagsToSearchArr[2], $tagsToSearchArr[3], $tagsToSearchArr[4]);
                break;
            case 6:
                $this->mysqli_stmt->bind_param('ssssss', $tagsToSearchArr[0], $tagsToSearchArr[1], $tagsToSearchArr[2], $tagsToSearchArr[3], $tagsToSearchArr[4], $tagsToSearchArr[5]);
                break;
            case 7:
                $this->mysqli_stmt->bind_param('sssssss', $tagsToSearchArr[0], $tagsToSearchArr[1], $tagsToSearchArr[2], $tagsToSearchArr[3], $tagsToSearchArr[4], $tagsToSearchArr[5], $tagsToSearchArr[6]);
                break;
            case 8:
                $this->mysqli_stmt->bind_param('ssssssss', $tagsToSearchArr[0], $tagsToSearchArr[1], $tagsToSearchArr[2], $tagsToSearchArr[3], $tagsToSearchArr[4], $tagsToSearchArr[5], $tagsToSearchArr[6], $tagsToSearchArr[7]);
                break;
            case 9:
                $this->mysqli_stmt->bind_param('sssssssss', $tagsToSearchArr[0], $tagsToSearchArr[1], $tagsToSearchArr[2], $tagsToSearchArr[3], $tagsToSearchArr[4], $tagsToSearchArr[5], $tagsToSearchArr[6], $tagsToSearchArr[7], $tagsToSearchArr[8]);
                break;
            case 10:
                $this->mysqli_stmt->bind_param('ssssssssss', $tagsToSearchArr[0], $tagsToSearchArr[1], $tagsToSearchArr[2], $tagsToSearchArr[3], $tagsToSearchArr[4], $tagsToSearchArr[5], $tagsToSearchArr[6], $tagsToSearchArr[7], $tagsToSearchArr[8], $tagsToSearchArr[9]);
                break;
        }

        $tagsThatDBAlreadyHas = NULL;
        $this->mysqli_stmt->execute();
        $this->mysqli_stmt->bind_result( $idTag1, $tag12);
        while ($this->mysqli_stmt->fetch()) {
            $one['idTag'] = $idTag1;
            $one['tag'] = $tag12;
            $tagsThatDBAlreadyHas[] = $one;
        }
        print_r($tagsThatDBAlreadyHas);

    //  Сравнение имеющихся тегов в БД с пришедшими из запроса
        $tagsDBFiltered = [];
        foreach ($tagsThatDBAlreadyHas as $tag) {
            $tagsDBFiltered[] = $tag['tag'];
        }
        $missedTags = array_diff($tagsToSearchArr, $tagsDBFiltered);

        if (!empty($missedTags)) {
            $this->tegAdjuster($missedTags);
        } else {
            $this->putterEntity->setTagsWithId($tagsThatDBAlreadyHas);
        }
    }

    /**
     * Осуществляет добавление тегов в БД, в случае если их там еще нет, механика рекурсива с function tegSearcher()
     * @param array $missedTags
     */
    private function tegAdjuster(array $missedTags): void
    {
        print_r($missedTags);



        $query = 'INSERT INTO main (teg) VALUES (?)';
        $this->mysqli_stmt->bind_param('s', $missedTags);



        $queryDirty = "INSERT INTO `tegs` (`id_teg`, `teg`) VALUES ";  //  подготовка запроса
        foreach ($missedTags as $tag) {
            $queryDirty .="(NULL, '$tag'), ";
        }
        $query = mb_substr($queryDirty, -0, -2);

        $this->clientAdd($query);                                      //  запрос на добавление
        $this->tegSearcher();                                           //  вызов f() прородителя
    }


/**
 * Пара question & answer являются уникальными значениями в БД
 * Проверяем пришедшую пару на предмет существования в БД, при необходимости - добавляем. 
 * Осуществлена механика рекурсива с необязательным параметром:
 * @param question - вопрос из запроса
 * @param answer   - ответ из запроса
 * @param stopper  - необязательный параметр: приходит из функции mainAdjuster() в случае добавления новой уникальной пары в БД
 */
    private function mainSearcher($question, $answer, $stopper = NULL): void 
    {
        $query = "SELECT * FROM main WHERE question = '$question' AND answer = '$answer'";         //  в начале проверка на предмет уже существующей пары вопрос/ответ
        $response = $this->clientGet($query);
        
        if (empty($response)) {                                                                     //  если пары нет, то $response пустой
            $this->mainAdjuster($question, $answer);                                                //      и тогда вызываем f() для добавления пары
        } elseif ($stopper !== NULL) {                                                              //  в случае если данная f() вызывается из mainAdjuster(), то выполняется это условие
            $this->putterEntity->setId($response);                                               //      запись main_id в хранилище
            $this->compoundAdjuster();                                                              //      и вызываем f() связыватель teg & main
        } elseif ($stopper == NULL) {
            $this->putterEntity->setId($response);                                               //  если пришла пара вопрос/ответ из главной f(), тогда только записываем main_id
        }
    }

/**
 * Осуществляет создание новой уникальной пары question & answer d БД
 * @param question - "вопрос" для создания
 * @param answer   - "ответ" для создания
 */
    private function mainAdjuster($question, $answer): void 
    {
        $url = $this->putterEntity->getUrl();                                                    //  вытягивание из хранилища доп необязательной инфы
        $date = $this->putterEntity->getDate();

        $query = "INSERT INTO `main` (`id_main`, `question`, `answer`, `url`, `date`) VALUES (NULL, '$question', '$answer'";
        !empty($url) ? ($query .= ", '$url'") : ($query .= ", NULL");                             //  что бы не менять тело запроса проще вставить NULL
        !empty($date) ? ($query .= ", '$date'") : ($query .= ", NULL");
        $query .= ")";

        $this->clientAdd($query);                                                                  //  осуществляем запрос на добавление строки
        $this->mainSearcher($question, $answer, 'added');                                           //  вызыв f() прородителя
    }


/**
 * Осуществляет связывание новой уникальной пары question & answer с тегами
 */
    private function compoundAdjuster(): void
    {
        $mainId = $this->putterEntity->getId();                                      //  вытягивание из хранилища mainId и tegId
        $tegId = $this->putterEntity->getTagsFromDB();

        $queryDirty = 'INSERT INTO `compound` (`id_main`, `id_teg`) VALUES ';          //  подготовка запроса
        foreach($tegId as $tag) {
            $oneTagId = $tag['id_teg'];
            $queryDirty .= "('$mainId', '$oneTagId'), ";
        }
        $query = mb_substr($queryDirty, -0, -2);

        $this->clientAdd($query);                                                      //  запрос
    }
} 
