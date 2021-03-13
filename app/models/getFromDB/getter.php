<?php

namespace app\models\getFromDB;

use app\models\lib\DataBaseChats;

class Getter
{
    private GetterEntity $getterEntity;
    private DataBaseChats $dataBaseChats;
    private \mysqli $mysqli;
    private \mysqli_stmt $mysqli_stmt;

    public function __construct()
    {
        $this->getterEntity = new GetterEntity();
        $this->dataBaseChats = new DataBaseChats();
        $this->mysqli = $this->dataBaseChats->getMysqli();
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
            WHERE tegs.teg IN ($numberParams) GROUP BY main.id_main HAVING (COUNT(*) = ?)";

    echo $query . "\n";
        $this->mysqli_stmt = $this->mysqli->prepare($query);

        switch ($tegsAmount){
            case 1:
                $this->mysqli_stmt->bind_param('ss', $tegsToSearchArr[0],  $tegsAmount);
                break;
            case 2:
                $this->mysqli_stmt->bind_param('sss', $tegsToSearchArr[0], $tegsToSearchArr[1], $tegsAmount);
                break;
            case 3:
                $this->mysqli_stmt->bind_param('ssss', $tegsToSearchArr[0], $tegsToSearchArr[1], $tegsToSearchArr[2], $tegsAmount);
                break;
            case 4:
                $this->mysqli_stmt->bind_param('sssss', $tegsToSearchArr[0], $tegsToSearchArr[1], $tegsToSearchArr[2], $tegsToSearchArr[3], $tegsAmount);
                break;
            case 5:
                $this->mysqli_stmt->bind_param('ssssss', $tegsToSearchArr[0], $tegsToSearchArr[1], $tegsToSearchArr[2], $tegsToSearchArr[3], $tegsToSearchArr[4], $tegsAmount);
                break;
            default:
                echo 'too many teg';
        }




        $this->mysqli_stmt->execute();
        $this->mysqli_stmt->bind_result($id_main, $question, $answer, $url);
        $this->mysqli_stmt->fetch();
        $this->mysqli_stmt->close();


        var_dump($id_main, $question, $answer, $url);



        if (!empty($result)) {
            $this->getterEntity->GEsetResultArr($result);
        } else {
            $this->getterEntity->GEsetResultEmpty();
        }   
    }
}
