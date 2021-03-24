<?php

namespace app\controllers;

use app\models\validate\Validate;
use app\models\getFromDB\Getter;
use app\models\putInDB\Putter;
use app\views\Error;
use app\views\GetInfo;
use app\views\PutInfo;

/**
 * Главный контроллер
 * Class Controller
 * @package app\controllers
 */
class MainController
{
    private Validate $validate;

    public function __construct()
    {
        $this->validate = new Validate;
    }

    /**
     * На данный момент это главная функция, вызываемся при заполнении форм
     * @param array $data массив входящих данных
     */
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


    /**
     * Вызыв модели для получения инфорамции из БД по тегам
     * @param array $data
     * @return array
     */
    public function getFromDB(array $data): array
    {
        $dbGetter = new Getter();
        return $dbGetter->mainGetter($data);
    }


    /**
     * Вызыв модели для добавления инфорамции в БД с тегами
     * @param array $data
     * @return array
     */
    public function putInDB(array $data): array
    {
        $dbPutter = new Putter();
        return $dbPutter->mainPutter($data);
    }

}
