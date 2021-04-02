<?php

namespace app\models\putInDB;

use app\models\lib\DataBaseChats;

/**
 * Class Putter для добалвения информации с тегами
 * @package app\models\putInDB
 */
class Putter
{
    private DataBaseChats $dataBaseChats;
    private PutterEntity $putterEntity;
    private \PDO $mysqli;

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

        // Подготовка данных для запроса
        $query = "SELECT * FROM tegs WHERE teg = ($numberParams)";

        $stmt = $this->mysqli->prepare($query);
        $stmt->execute($tagsToSearchArr);

        $tagsThatDBAlreadyHas = NULL;
        while ($row = $stmt->fetch(\PDO::FETCH_LAZY))
        {
            $one['idTag'] = $row['id_teg'];
            $one['tag'] = $row['teg'];
            $tagsThatDBAlreadyHas[] = $one;
        }

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
        $query = 'INSERT INTO tegs (teg) VALUES (?)';
        $stmt = $this->mysqli->prepare($query);

        foreach ($missedTags as $tag) {
            $stmt->execute(array($tag));
        }

        //  вызов функции чекера
        $this->tegSearcher();
    }


/**
 * Пара question & answer являются уникальными значениями в БД
 * Проверяем пришедшую пару на предмет существования в БД, при необходимости - добавляем. 
 * Осуществлена механика рекурсива с необязательным параметром:
 * @param string question - вопрос из запроса
 * @param string answer   - ответ из запроса
 * @param ?Null stopper   - необязательный параметр: приходит из функции mainAdjuster() в случае добавления новой уникальной пары в БД
 */
    private function mainSearcher(string $question, string $answer, $stopper = NULL): void
    {
        $query = "SELECT main.id_main, main.question, main.answer, main.url, main.date FROM main WHERE question = ? AND answer = ?";
        $stmt = $this->mysqli->prepare($query);
        $stmt->execute(array($question, $answer));
        $stmt->fetch();
        $row = $stmt->fetch(\PDO::FETCH_LAZY);

        if ($row == false) {                                                                  //  если пары нет, то $response пустой
            $this->mainAdjuster($question, $answer);                                                //      и тогда вызываем f() для добавления пары
        } elseif ($stopper !== NULL) {                                                        //  в случае если данная f() вызывается из mainAdjuster(), то выполняется это условие
            $this->putterEntity->setId($row['id_main']);                                            //      запись main_id в хранилище
            $this->compoundAdjuster();                                                              //      и вызываем f() связыватель teg & main
        } elseif ($stopper == NULL) {                                                         //   если пришла пара вопрос/ответ из главной f(), и есть уже такая пара,
            $this->putterEntity->setId($row['id_main']);                                            //   то записываем main_id
        }
    }

/**
 * Осуществляет создание новой уникальной пары question & answer d БД
 * @param question - "вопрос" для создания
 * @param answer   - "ответ" для создания
 */
    private function mainAdjuster($question, $answer): void 
    {
        $url = $this->putterEntity->getUrl();                                                 //  вытягивание из хранилища доп необязательной инфы
        $date = $this->putterEntity->getDate();

        if (empty($url)) {
            $url = NULL;
        }
        if (empty($date)) {
            $date = NULL;
        }
        $query = "INSERT INTO main (question, answer, url, date) VALUES (?, ?, ?, ?)";

        $stmt = $this->mysqli->prepare($query);
        $stmt->execute(array($question, $answer, $url, $date));

        $this->mainSearcher($question, $answer, 'added');                             //  рекурсив
    }


/**
 * Осуществляет связывание новой уникальной пары question & answer с тегами
 */
    private function compoundAdjuster(): void
    {
        $idMain = $this->putterEntity->getId();
        $tagId = $this->putterEntity->getTagsFromDB();

        $query = "INSERT INTO compound (id_main, id_teg) VALUES (?, ?)";
        $stmt = $this->mysqli->prepare($query);
        foreach ($tagId as $tag) {
            $stmt->execute(array($idMain, $tag['idTag']));
        }

    }
} 
