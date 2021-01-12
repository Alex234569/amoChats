<?php

class InfoFromDB extends Controller
{
    private DB $db;
//    private array $outData;
    private string $question;
    private string $answer;
    private ?string $url = NULL;
    private ?string $date = NULL;


    public function __construct()
    {
        $this->db = new DB;
    }

    public function getQuestion (): string
    {
        return $this->question;
    }
    


/**
* Осущесвляет подготовку данных для передачи в запрос
* @param data входящий массив, содержащий теги на запрос
*/

    private function fromArr($data): array
    {
        $countElements = count($data);          //  узнаем число тегов в запросе (необходимо в запросе к БД)

        $tegString = '';
        foreach ($data as $one) {
            $tegString .= "'" . $one . "'" . ", ";          //  делаю строку для поиска для более универсальной функции запроса
        }
        $tegStringFilter = mb_substr($tegString, -0, -2);   //  обрезаю последние 2 символа строки (это запятая + пробел)

        $returnArr = [];                                    //  выводной массив
        $returnArr = [
            'countElements' => "$countElements",            //  кол-во тегов для запроса
            'tegStringFilter' => "$tegStringFilter",        //  строка с тегами
        ];

        return $returnArr;
    }


/**
* Осуществляет запрос к БД
* @param countElements     Количество тегов в запросе
* @param tegStringFilter   Строка с тегами, формата 'тег1', 'тег2'
*/

    public function dbOut($data): void
    {
        $valueMix = $this->fromArr($data);
        $countElements = $valueMix['countElements'];
        $tegStringFilter = $valueMix['tegStringFilter'];

        $query = "SELECT main.question, main.answer, main.url, main.date 
            FROM main 
            LEFT JOIN compound ON main.id_main = compound.id_main 
            LEFT JOIN tegs ON compound.id_teg = tegs.id_teg 
            WHERE tegs.teg IN ($tegStringFilter) 
            GROUP BY main.id_main 
            HAVING (COUNT(*) = $countElements)";

        $result = $this->db->client($query);
//        $this->outData = $result;
//        print_r($result);        

        foreach ($result as $res) {
//            $this->mainData->MDsetQuestion($res['question']);
//            $this->mainData->MDsetAnswer($res['answer']);
//            $this->mainData->MDsetUrl($res['url']);
//            $this->mainData->MDsetDate($res['date']);

        }
//        var_dump($this->MDquestion);
//        print_r($this->MDgetQuestion());
        
    }

}
