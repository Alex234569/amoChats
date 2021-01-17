<?php

include_once 'db/db.php';
include_once 'db/dbPutter.php';
include_once 'db/dbGetter.php';
include_once 'validate.php';

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
        
        
        
        
        
        
        echo "<pre>";
        print_r($res);
    }


/**
 * функция вызова класса, отвечающего за получение информации из БД
 * @param data - входящий массив информации из html формы 
*/   
    public function getFromDB(string $data): array
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



    public function validationOfIncomming()
    {

    }

}