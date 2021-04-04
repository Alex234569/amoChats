<?php

namespace app\models\getFromDB;

use app\models\lib\DataBaseChats;
use app\models\validate\ValidateModel;

/**
 * Class Getter для получения информации по тегам
 * @package app\models\getFromDB
 */
class Getter
{
    private GetterModel $getterModel;
    private DataBaseChats $dataBaseChats;
    private \PDO $mysqli;

    public function __construct(ValidateModel $data)
    {
        $this->getterModel = new GetterModel($data);
        $this->dataBaseChats = new DataBaseChats();
        $this->mysqli = $this->dataBaseChats->getMysqli();
    }


    /**
     * Основая функция контролирующая получение информации по тегам
     * @return GetterModel
     */
    public function mainGetter(): GetterModel
    {
        $mainInfoWithoutTag = $this->mainSearcher();
        empty($mainInfoWithoutTag) ? $this->getterModel->setResultEmpty() : $this->addTegToResult($mainInfoWithoutTag);
        return $this->getterModel;
    }


    /**
     * Ищет пару вопрос+ответ по полученным тегам
     * @return array
     */
    private function mainSearcher(): ?array
    {
        $tagsToSearchArr = $this->getterModel->getTagsToSearchArr();
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

        $this->getterModel->setResultArr($data);
    }
}



