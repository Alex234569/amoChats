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
    private \PDO $mysqli;

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

        // Подготовка данных для запроса
        $dataToExecute = $tagsToSearchArr;
        $dataToExecute[] = $tagsAmount;
        $query = "SELECT main.id_main, main.question, main.answer, main.url, main.date FROM main 
            LEFT JOIN compound ON main.id_main = compound.id_main 
            LEFT JOIN tegs ON compound.id_teg = tegs.id_teg 
            WHERE tegs.teg IN ($numberParams) GROUP BY main.id_main HAVING (COUNT(*) = ?)";

        $stmt = $this->mysqli->prepare($query);
        $stmt->execute($dataToExecute);

        $result = NULL;
        while ($row = $stmt->fetch(\PDO::FETCH_LAZY))
        {
            $one['idMain'] = $row['id_main'];
            $one['question'] = $row['question'];
            $one['answer'] = $row['answer'];
            $one['url'] = $row['url'];
            $one['date'] = $row['date'];
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
            $stmt = $this->mysqli->prepare($query);

            $stmt->execute(array($one['idMain']));
            while ($row = $stmt->fetch(\PDO::FETCH_LAZY)) {
                $tags[] = $row['teg'];
            }
            $data[$key]['tag'] = implode(' ', $tags);
        }

        $this->getterEntity->setResultArr($data);
    }
}



