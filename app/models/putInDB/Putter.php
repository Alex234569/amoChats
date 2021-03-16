<?php

namespace app\models\putInDB;

use app\models\lib\DataBaseChats;

class Putter
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

        $this->tegSearcher();
        $question = $this->putterEntity->getQuestion();
        $answer = $this->putterEntity->getAnswer();
        $this->mainSearcher($question, $answer);

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
        $this->mysqli_stmt->close();

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
// todo:  bind_param() with a dynamic number of arguments

        $query = 'INSERT INTO tegs (teg) VALUES (?)';
        $this->mysqli_stmt = $this->mysqli->prepare($query);

        foreach ($missedTags as $tag) {
            print_r($tag);
            $this->mysqli_stmt->bind_param('s', $tag);
            $this->mysqli_stmt->execute();
        }
        $this->mysqli_stmt->close();

        //  вызов функции чекера
        $this->tegSearcher();
    }


/**
 * Пара question & answer являются уникальными значениями в БД
 * Проверяем пришедшую пару на предмет существования в БД, при необходимости - добавляем. 
 * Осуществлена механика рекурсива с необязательным параметром:
 * @param string question - вопрос из запроса
 * @param string answer   - ответ из запроса
 * @param ?Null stopper  - необязательный параметр: приходит из функции mainAdjuster() в случае добавления новой уникальной пары в БД
 */
    private function mainSearcher(string $question, string $answer, $stopper = NULL): void
    {


        $query = "SELECT main.id_main, main.question, main.answer, main.url, main.date FROM main WHERE question = ? AND answer = ?";
        $this->mysqli_stmt = $this->mysqli->prepare($query);
        $this->mysqli_stmt->bind_param('ss', $question, $answer);
        $this->mysqli_stmt->execute();
        $this->mysqli_stmt->bind_result( $idMain, $question, $answer, $url, $date);
        $this->mysqli_stmt->fetch();
        $this->mysqli_stmt->close();

        if (empty($idMain)) {                                                                     //  если пары нет, то $response пустой
            $this->mainAdjuster($question, $answer);                                                //      и тогда вызываем f() для добавления пары
        } elseif ($stopper !== NULL) {                                                              //  в случае если данная f() вызывается из mainAdjuster(), то выполняется это условие
            $this->putterEntity->setId($idMain);                                               //      запись main_id в хранилище
            $this->compoundAdjuster();                                                              //      и вызываем f() связыватель teg & main
        } elseif ($stopper == NULL) {
            $this->putterEntity->setId($idMain);                                               //  если пришла пара вопрос/ответ из главной f(), тогда только записываем main_id
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

        if (empty($url)) {
            $url = NULL;
        }
        if (empty($date)) {
            $date = NULL;
        }
        $query = "INSERT INTO main (question, answer, url, date) VALUES (?, ?, ?, ?)";

        $this->mysqli_stmt = $this->mysqli->prepare($query);
        $this->mysqli_stmt->bind_param('ssss', $question, $answer, $url, $date);
        $this->mysqli_stmt->execute();
        $this->mysqli_stmt->close();

        $this->mainSearcher($question, $answer, 'added');                                           //  вызыв f() прородителя
    }


/**
 * Осуществляет связывание новой уникальной пары question & answer с тегами
 */
    private function compoundAdjuster(): void
    {
        $idMain = $this->putterEntity->getId();                                      //  вытягивание из хранилища mainId и tegId
        $tagId = $this->putterEntity->getTagsFromDB();

        $query = "INSERT INTO compound (id_main, id_teg) VALUES (?, ?)";
        $this->mysqli_stmt = $this->mysqli->prepare($query);
        foreach ($tagId as $tag) {
            $this->mysqli_stmt->bind_param('ss', $idMain, $tag['idTag']);
            $this->mysqli_stmt->execute();
        }

    }
} 
