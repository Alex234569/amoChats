<?php

namespace app\models\getFromDB;

use app\models\lib\DataBaseChats;

/**
 * Class Getter для получения информации по тегам
 * @package app\models\getFromDB
 */
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
     * Основая функция контролирующая получение информации по тегам
     * @param array $data
     * @return array
     */
    public function mainGetter(array $data): array
    {
        $this->getterEntity->separator($data);
        $mainInfoWithoutTag = $this->mainSearcher();
        empty($mainInfoWithoutTag) ? $this->getterEntity->setResultEmpty() : $this->addTegToResult($mainInfoWithoutTag);
        return $this->getterEntity->getResult();
    }


    /**
     * Ищет пару вопрос+ответ по полученным тегам
     * @return array
     */
    private function mainSearcher(): ?array
    {
        $tagsToSearchArr = $this->getterEntity->getTagsToSearchArr();
        $tagsAmount = count($tagsToSearchArr);

        $numberParams = '';
        for ($n = 0; $n < $tagsAmount; $n++){
            $numberParams .= '?, ';
        }
        $numberParams = mb_substr($numberParams, -0, -2);

        $query = "SELECT main.id_main, main.question, main.answer, main.url, main.date FROM main 
            LEFT JOIN compound ON main.id_main = compound.id_main 
            LEFT JOIN tegs ON compound.id_teg = tegs.id_teg 
            WHERE tegs.teg IN ($numberParams) GROUP BY main.id_main HAVING (COUNT(*) = ?)";

        $this->mysqli_stmt = $this->mysqli->prepare($query);
        switch ($tagsAmount){
            case 1:
                $this->mysqli_stmt->bind_param('ss', $tagsToSearchArr[0],  $tagsAmount);
                break;
            case 2:
                $this->mysqli_stmt->bind_param('sss', $tagsToSearchArr[0], $tagsToSearchArr[1], $tagsAmount);
                break;
            case 3:
                $this->mysqli_stmt->bind_param('ssss', $tagsToSearchArr[0], $tagsToSearchArr[1], $tagsToSearchArr[2], $tagsAmount);
                break;
            case 4:
                $this->mysqli_stmt->bind_param('sssss', $tagsToSearchArr[0], $tagsToSearchArr[1], $tagsToSearchArr[2], $tagsToSearchArr[3], $tagsAmount);
                break;
            case 5:
                $this->mysqli_stmt->bind_param('ssssss', $tagsToSearchArr[0], $tagsToSearchArr[1], $tagsToSearchArr[2], $tagsToSearchArr[3], $tagsToSearchArr[4], $tagsAmount);
                break;
            default:
                echo 'too many tags';
        }

        $result = NULL;
        $this->mysqli_stmt->execute();
        $this->mysqli_stmt->bind_result( $idMain, $question, $answer, $url, $date);
        while ($this->mysqli_stmt->fetch()) {
            $one['idMain'] = $idMain;
            $one['question'] = $question;
            $one['answer'] = $answer;
            $one['url'] = $url;
            $one['date'] = $date;
            $result[] = $one;
        }

        return $result;
    }


    /**
     * Добалвение списка тегов к паре вопрос+ответ
     * @param array $data
     */
    private function addTegToResult(array $data): void
    {
        foreach ($data as $key => $one) {
            $tags = [];
            $query = "SELECT tegs.teg FROM main 
                LEFT JOIN compound ON main.id_main = compound.id_main 
                LEFT JOIN tegs ON compound.id_teg = tegs.id_teg 
                WHERE main.id_main = ?";
            $this->mysqli_stmt->prepare($query);
            $this->mysqli_stmt->bind_param('s', $one['idMain']);
            $this->mysqli_stmt->execute();
            $this->mysqli_stmt->bind_result($tag);
            while ($this->mysqli_stmt->fetch()) {
                $tags[] = $tag;
            }
            $data[$key]['tag'] = implode(' ', $tags);
        }

        $this->mysqli_stmt->close();
        $this->getterEntity->setResultArr($data);
    }
}



