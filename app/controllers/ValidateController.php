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

    public function main(array $data): array
    {
        if ($data['button'] == 'getInfo' || $data['button'] == 'addInfo'){
            return $this->putInfo($data);
        }
    }

    /**
     * @param array $data
     * @return array
     */
    private function putInfo(array $data): array
    {
        $validate = new Val($data['button']);
        $validate
            ->setTag($data['tag'])
            ->setQuestion(isset ($data['question']) ? $data['question'] : NULL)
            ->setAnswer(isset ($data['answer']) ? $data['answer'] : NULL)
            ->setUrl(isset ($data['url']) ? $data['url'] : NULL)
            ->setDate(isset ($data['date']) ? $data['url'] : NULL);

        return $validate->getAll();
    }
}