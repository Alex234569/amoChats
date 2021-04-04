<?php

namespace app\controllers;

use app\models\getFromDB\Getter;
use app\models\getFromDB\GetterModel;
use app\models\putInDB\Putter;
use app\models\validate\ValidateModel;
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
    /**
     * На данный момент это главная функция, вызываемся при заполнении форм
     * @param ValidateModel $data
     */
    public function mainController(ValidateModel $data): void
    {
        $button = $data->getButton();
        switch ($button) {
            case 'getInfo':
                $getInfoRes = $this->getFromDB($data);
                if ($getInfoRes->isStop() === true) {
                    Error::error($getInfoRes->getError());
                } else {
                    GetInfo::getInfo($getInfoRes);
                }


            //    isset($getInfoRes['stop']) ? Error::error($getInfoRes['error']) : GetInfo::getInfo($getInfoRes);
                break;
            case 'addInfo':
                $putInfoRes = $this->putInDB($data);
                isset($putInfoRes['stop']) ? Error::error($putInfoRes['error']) : PutInfo::putInfo($putInfoRes);
        }
    }


    /**
     * Вызыв модели для получения инфорамции из БД по тегам
     * @param ValidateModel $data
     * @return GetterModel
     */
    public function getFromDB(ValidateModel $data): GetterModel
    {
        $dbGetter = new Getter($data);
        return $dbGetter->mainGetter();
    }


    /**
     * Вызыв модели для добавления инфорамции в БД с тегами
     * @param ValidateModel $data
     * @return array
     */
    public function putInDB(ValidateModel $data): array
    {
        $dbPutter = new Putter($data);
        return $dbPutter->mainPutter();
    }

}
