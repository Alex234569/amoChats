<?php

namespace app\controllers;

use app\models\validate\Validate;
use app\models\validate\ValidateModel;
use app\models\validate\Getter;
use app\models\validate\Putter;



use app\views\Error;

class ValidateController
{
    private Validate $validate;

    public function __construct()
    {
        $this->validate = new Validate();
    }

    public function main(array $data)
    {
    //    print_r($data);


        switch ($data['button'])
        {
            case 'getInfo':
                $this->getInfo($data);
            case 'addInfo':

            case 'simulate':

            default:
                $this->stop = true;
                $this->error = 'No such case to validate (/inc/Validate.php)';

                return $this->getError();
        }



    }

    private function getInfo(array $data)
    {
        $getter = new Getter();
        $getter->main($data);

    }

    private function putInfo()
    {
        $putter = new Putter();

    }

    private function simulate()
    {

    }
}