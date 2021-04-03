<?php

namespace app\controllers;

use app\models\getFromDB\Getter;
use app\models\putInDB\Putter;
use app\models\validate\Validate;
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

    public function __construct()
    {
    }

    /**
     * На данный момент это главная функция, вызываемся при заполнении форм
     * @param array $data массив входящих данных
     */
    public function mainController(Validate $data): void
    {
        $button = $data->getButton();
        switch ($button) {
            case 'getInfo':
                $getInfoRes = $this->getFromDB($data);
                isset($getInfoRes['stop']) ? Error::error($getInfoRes['error']) : GetInfo::getInfo($getInfoRes);
                break;
            case 'addInfo':
                $putInfoRes = $this->putInDB($data);
                isset($putInfoRes['stop']) ? Error::error($putInfoRes['error']) : PutInfo::putInfo($putInfoRes);
        }
    }


    /**
     * Вызыв модели для получения инфорамции из БД по тегам
     * @param Validate $data
     * @return array
     */
    public function getFromDB(Validate $data): array
    {
        $dbGetter = new Getter($data);
        return $dbGetter->mainGetter();
    }


    /**
     * Вызыв модели для добавления инфорамции в БД с тегами
     * @param Validate $data
     * @return array
     */
    public function putInDB(Validate $data): array
    {
        $dbPutter = new Putter($data);
        return $dbPutter->mainPutter();
    }

}
