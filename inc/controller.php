<?php

include_once 'db/db.php';
include_once 'db/dbPutter.php';
include_once 'db/dbGetter.php';
include_once 'validate.php';
include_once 'divToSite.php';

class Controller
{
    private DBPutter $dbPutter;
    private DBGetter $dbGetter;
    private Validate $validate;

    public function __construct()
    {
        $this->validate = new Validate;
    }
 

    public function mainController(array $data): void 
    {
        $validate = $this->validate->validator($data);

        if (isset($validate['error'])) {
            DivToSite::DSerror($validate['error']);
        } else {
            switch ($validate['whatToDo']){
                case 'getInfo':
                    $getInfoRes = $this->getFromDB($validate);
                    isset($getInfoRes['stop']) ? DivToSite::DSerror($getInfoRes['error']) : DivToSite::DSgetInfo($getInfoRes);
                    break;
                case 'addInfo':
                    $putInfoRes = $this->putInDB($validate);
                    isset($putInfoRes['stop']) ? DivToSite::DSerror($putInfoRes['error']) : DivToSite::DSputInfo($putInfoRes);
            }
        }
    }


/**
 * функция вызова класса, отвечающего за получение информации из БД
 * @param data - входящий массив информации из html формы
*/   
    public function getFromDB(array $data): array
    {
        $this->dbGetter = new DBGetter();
        $result = $this->dbGetter->mainGetter($data);
        return $result;
    }


/**
 * функция вызова класса, отвечающего за добавление информации в БД
 * @param data - входящий массив информации из html формы 
*/    
    public function putInDB(array $data): array
    {
        $this->dbPutter = new DBPutter();
        $result = $this->dbPutter->mainPutter($data);
        return $result;
    }

}
