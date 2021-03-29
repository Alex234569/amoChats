<?php

namespace app\controllers;

use app\models\validate\Validate;
use app\models\validate\ValidateModel;
use app\models\validate\Val;
use app\models\validate\Getter;
use app\models\validate\Putter;



use app\views\Error;

class ValidateController
{

    public function __construct()
    {
    }

    public function main(array $data)
    {
        switch ($data['button'])
        {
            case 'getInfo':
                return $this->getInfo($data);
            case 'addInfo':
                return $this->putInfo($data);
            case 'simulate':
                return '';
        }
    }

    private function getInfo(array $data): array
    {
        $validate = new Val($data['button'], $data['tag']);
        $validate->setTag();
        return $validate->getAll();
    }

    private function putInfo(array $data)
    {
        echo "<div class='center'>";
        echo "<pre>";
        print_r($data);
        $validate = new Val(
            $data['button'],
            $data['tag'],
            $data['question'],
            $data['answer'],
            isset ($data['url']) ? $data['url']: null,
            isset ($data['date']) ? $data['url']: null
        );
        $validate
            ->setTag()
            ->question()
            ->answer()
            ->url()
            ->date();

        print_r($validate);
    }

    private function simulate()
    {

    }
}