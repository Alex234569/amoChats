<?php

include_once 'db/db.php';
include_once 'db/dbPutter.php';
include_once 'db/dbGetter.php';
include_once 'validate.php';
include_once 'divToSite.php';

class Controller
{
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



    public function getFromDB(array $data): array
    {
        $dbGetter = new DBGetter();
        return $dbGetter->mainGetter($data);
    }



    public function putInDB(array $data): array
    {
        $dbPutter = new DBPutter();
        return $dbPutter->mainPutter($data);
    }

}
