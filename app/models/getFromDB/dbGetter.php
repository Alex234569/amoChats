<?php

namespace app\models\getFromDB;

use app\models\getFromDB\getterEntity;
use app\models\lib\dbConnector;

class DBGetter
{
    private GetterEntity $getterEntity;
    private DBConnector $dbConnector;
    private mysqli $mysqli;
    private mysqli_stmt $mysqli_stmt;

    public function __construct()
    {
        $this->getterEntity = new GetterEntity();
        $this->dbConnector = new DBConnector();
        $this->mysqli = $this->dbConnector->getMysqli();
    }


/**
 * Основная функция, отвечающая за порядок запросов
 * @param data входящий массив, это строка с перечислением тегов
 */
    public function mainGetter(array $data): array
    {
        echo "<pre>";
        $this->getterEntity->GEsetData($data);                  //  отправка данных из запроса в хранилище
        print_r($this->getterEntity);
        $this->mainSearcher();
        return $this->getterEntity->GEgetAll();
    }


/**
 * олтвечает за поиск информации по тегам
 */
    private function mainSearcher(): void
    {
        $tegsToSearchArr = $this->getterEntity->GEgetTegsToSearchArr();

        $tegsAmount = count($tegsToSearchArr);

        for ($n = 0; $n < $tegsAmount; $n++){
            $numberParams .= '?, ';
        }
        $numberParams = mb_substr($numberParams, -0, -2);

        $query = "SELECT main.question, main.answer, main.url, main.date FROM main 
            LEFT JOIN compound ON main.id_main = compound.id_main 
            LEFT JOIN tegs ON compound.id_teg = tegs.id_teg 
            WHERE tegs.teg IN ($numberParams) GROUP BY main.id_main HAVING (COUNT(*) = ?";

        $this->mysqli_stmt = $this->mysqli->prepare($query);
        echo '+';



        $result = $this->clientGet($query);

        if (!empty($result)) {
            $this->getterEntity->GEsetResultArr($result);
        } else {
            $this->getterEntity->GEsetResultEmpty();
        }   
    }
}
