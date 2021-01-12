<?php

include_once 'getterStorage.php';

class DBGetter extends Controller
{
    use DB;
    private GetterStorage $getterStorage;

    public function __construct()
    {
        $this->getterStorage = new GetterStorage();
    }


/**
 * Основная функция, отвечающая за порядок запросов
 * @param data входящий массив, это строка с перечислением тегов
 */
    public function mainGetter(string $data): array
    {
        $this->DBconstruct();                                   //  вызов конструктора и деструктора для БД
        $this->getterStorage->GSsetTegsToSearch($data);         //  отправка данных из запроса в хранилище
        $this->mainSearcher();
        $this->DBdestruct();

        return $this->getterStorage->GSgetAll();
    }


/**
 * олтвечает за поиск информации по тегам
 */
    private function mainSearcher()
    {
        $tegsToSearch = $this->getterStorage->GSgetTegsToSearch();

        $tegsAmount = count($tegsToSearch);

        $querry = " SELECT main.question, main.answer, main.url, main.date FROM main 
            LEFT JOIN compound ON main.id_main = compound.id_main 
            LEFT JOIN tegs ON compound.id_teg = tegs.id_teg WHERE tegs.teg IN ";

        $querryPartDirty = "(";
        foreach ($tegsToSearch as $teg) {
            $querryPartDirty .= "'$teg', ";
        }
        $querryPart = mb_substr($querryPartDirty, -0, -2);
        $querryPart .= ")";

        $querry .= "$querryPart GROUP BY main.id_main HAVING (COUNT(*) = $tegsAmount)";  
        
        $result = $this->clientGet($querry);

        if (!empty($result)) {
            $this->getterStorage->GSsetMainArrays($result);
        } else {
            $result = ['nothing' => 'nothing'];
            $this->getterStorage->GSsetMainArrays($result);
        }   
    }
}
