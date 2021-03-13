<?php

namespace app\controllers;

use app\models\validate\validate;
use app\models\getFromDB\Getter;
use app\models\putInDB\dbPutter;
use app\views\Error;
use app\views\GetInfo;
use app\views\PutInfo;

/**
 * Главный контроллер
 * Class Controller
 * @package app\controllers
 */
class Controller
{
    private Validate $validate;

    public function __construct()
    {
        $this->validate = new Validate;
    }


    public function mainController(array $data): void 
    {
        if (!empty($data)) {
            $validate = $this->validate->validator($data);
            if (isset($validate['error'])) {
                Error::error($validate['error']);
            } else {
                switch ($validate['whatToDo']) {
                    case 'getInfo':
                        $getInfoRes = $this->getFromDB($validate);
                        isset($getInfoRes['stop']) ? Error::error($getInfoRes['error']) : GetInfo::getInfo($getInfoRes);
                        break;
                    case 'addInfo':
                        $putInfoRes = $this->putInDB($validate);
                        isset($putInfoRes['stop']) ? Error::error($putInfoRes['error']) : PutInfo::putInfo($putInfoRes);
                }
            }
        }
    }



    public function getFromDB(array $data): array
    {
        $dbGetter = new Getter();
        return $dbGetter->mainGetter($data);
    }



    public function putInDB(array $data): array
    {
        $dbPutter = new DBPutter();
        return $dbPutter->mainPutter($data);
    }

}
