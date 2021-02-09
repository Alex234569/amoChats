<?php

include_once 'getterEntity.php';

class DBGetter extends Controller
{
    use DB;
    private GetterEntity $getterEntity;

    public function __construct()
    {
        $this->getterEntity = new GetterEntity();
    }


/**
 * Основная функция, отвечающая за порядок запросов
 * @param data входящий массив, это строка с перечислением тегов
 */
    public function mainGetter(array $data): array
    {
        $this->DBconstruct();                                   //  вызов конструктора и деструктора для БД
        $this->getterEntity->GEsetData($data);                  //  отправка данных из запроса в хранилище
        $this->mainSearcher();
        $this->DBdestruct();
        return $this->getterEntity->GEgetAll();
    }


/**
 * олтвечает за поиск информации по тегам
 */
    private function mainSearcher(): void
    {
        $tegsToSearchArr = $this->getterEntity->GEgetTegsToSearchArr();

        $tegsAmount = count($tegsToSearchArr);

        $querry = "SELECT main.question, main.answer, main.url, main.date FROM main 
            LEFT JOIN compound ON main.id_main = compound.id_main 
            LEFT JOIN tegs ON compound.id_teg = tegs.id_teg WHERE tegs.teg IN ";

        $querryPart = "('" . implode("', '", $tegsToSearchArr) . "')";
        $querry .= "$querryPart GROUP BY main.id_main HAVING (COUNT(*) = $tegsAmount)";  
        
        $result = $this->clientGet($querry);

        if (!empty($result)) {
            $this->getterEntity->GEsetResultArr($result);
        } else {
            $this->getterEntity->GEsetResultEmpty();
        }   
    }
}
