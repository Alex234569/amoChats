<?php

namespace application\models\putInDB;

use PutterEntity;
use application\models\lib\db;

class DBPutter
{
    use DB;
    private PutterEntity $putterEntity;

    public function __construct()
    {
        $this->putterEntity = new PutterEntity();
    }

/**
 * Основная функция, отвечающая за порядок запросов
 * @param data входящий массив с данными для добавление в БД
 */
    public function mainPutter(array $data)
    {
        $this->DBconstruct();

        $this->putterEntity->PEseparator($data);                       //  все данные записаны в виде объектов в классе-хранителе
        $this->tegSearcher();                                           //  теперь есть все необходимые теги с id
    
        $question = $this->putterEntity->PEgetQuestion();              
        $answer = $this->putterEntity->PEgetAnswer();
        $this->mainSearcher($question, $answer);                        //  создание main и связи с тегами

        $this->DBdestruct();

        return $this->putterEntity->PEgetAll();
    }


/**
 * осуществляет запрос пришедших тегов на предмет их существования в БД
 */
    private function tegSearcher(): void
    {
        $tegsToSearchArr = $this->putterEntity->PEgetTegsToSearch();       //  теги, которые пришли из поиска

        $querry = "SELECT * FROM tegs WHERE teg = '";                   //  подготовка запроса на вытаскивание нужных тегов с id
        $querry .= implode("' OR teg = '", $tegsToSearchArr);
        $querry .= "'";

        $tegsThatDBAlreadyHas = $this->clientGet($querry);              //  если теги из запроса есть в БД то они будут выведены вместе с id_teg

        $tegsDBFiltered = [];                                           //  массив будет содержать только названия тегов из БД (без id, необходимо для сравнения ниже)
        foreach ($tegsThatDBAlreadyHas as $teg) {
            $tegsDBFiltered[] = $teg['teg'];
        }
        $missedTegs = array_diff($tegsToSearchArr, $tegsDBFiltered);       //  сравнение: теги, которые пришли из запроса, с тегами, которые уже есть в бд

        if (!empty($missedTegs)) {                                      //  если не все теги есть в БД, то вызывается функция для их добавления
            $this->tegAdjuster($missedTegs);
        } else {
            $this->putterEntity->PEsetTegsWithId($tegsThatDBAlreadyHas);   //  сохраняем теги с id в классе-хранителе
        }
    }

/**
 * Осуществляет добавление тегов в БД, в случае если их там еще нет, механика рекурсива с function tegSearcher()
 * @param missedTegs - теги на добавление в БД
 */
    private function tegAdjuster(array $missedTegs): void
    {
        $querryDirty = "INSERT INTO `tegs` (`id_teg`, `teg`) VALUES ";  //  подготовка запроса
        foreach ($missedTegs as $teg) {
            $querryDirty .="(NULL, '$teg'), ";
        }
        $querry = mb_substr($querryDirty, -0, -2);

        $this->clientAdd($querry);                                      //  запрос на добавление
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
        $querry = "SELECT * FROM main WHERE question = '$question' AND answer = '$answer'";         //  в начале проверка на предмет уже существующей пары вопрос/ответ
        $response = $this->clientGet($querry);
        
        if (empty($response)) {                                                                     //  если пары нет, то $response пустой
            $this->mainAdjuster($question, $answer);                                                //      и тогда вызываем f() для добавления пары
        } elseif ($stopper !== NULL) {                                                              //  в случае если данная f() вызывается из mainAdjuster(), то выполняется это условие
            $this->putterEntity->PEsetId($response);                                               //      запись main_id в хранилище
            $this->compoundAdjuster();                                                              //      и вызываем f() связыватель teg & main
        } elseif ($stopper == NULL) {
            $this->putterEntity->PEsetId($response);                                               //  если пришла пара вопрос/ответ из главной f(), тогда только записываем main_id
        }
    }

/**
 * Осуществляет создание новой уникальной пары question & answer d БД
 * @param question - "вопрос" для создания
 * @param answer   - "ответ" для создания
 */
    private function mainAdjuster($question, $answer): void 
    {
        $url = $this->putterEntity->PEgetUrl();                                                    //  вытягивание из хранилища доп необязательной инфы
        $date = $this->putterEntity->PEgetDate();

        $querry = "INSERT INTO `main` (`id_main`, `question`, `answer`, `url`, `date`) VALUES (NULL, '$question', '$answer'";
        !empty($url) ? ($querry .= ", '$url'") : ($querry .= ", NULL");                             //  что бы не менять тело запроса проще вставить NULL
        !empty($date) ? ($querry .= ", '$date'") : ($querry .= ", NULL");
        $querry .= ")";

        $this->clientAdd($querry);                                                                  //  осуществляем запрос на добавление строки
        $this->mainSearcher($question, $answer, 'added');                                           //  вызыв f() прородителя
    }


/**
 * Осуществляет связывание новой уникальной пары question & answer с тегами
 */
    private function compoundAdjuster(): void
    {
        $mainId = $this->putterEntity->PEgetId();                                      //  вытягивание из хранилища mainId и tegId
        $tegId = $this->putterEntity->PEgetTegsFromDB();

        $querryDirty = 'INSERT INTO `compound` (`id_main`, `id_teg`) VALUES ';          //  подготовка запроса
        foreach($tegId as $teg) {
            $oneTegId = $teg['id_teg'];
            $querryDirty .= "('$mainId', '$oneTegId'), ";
        }
        $querry = mb_substr($querryDirty, -0, -2);

        $this->clientAdd($querry);                                                      //  запрос
    }
} 
