<?php

namespace app\controllers;

use app\models\validate\Validate;


class ValidateController
{

    public function __construct()
    {
    }

    /**
     * Основной контроллер валидаторов
     * @param array $data
     * @return array
     */
    public function main(array $data): Validate
    {
        if ($data['button'] == 'getInfo' || $data['button'] == 'addInfo'){
            return $this->putInfo($data);
        }
    }

    /**
     * Обработчкик поступающей информации из форм
     * @param array $data
     * @return array
     */
    private function putInfo(array $data): Validate
    {
        $validate = new Validate($data['button']);
        $validate
            ->setTag($data['tag'])
            ->setQuestion(isset ($data['question']) ? $data['question'] : NULL)
            ->setAnswer(isset ($data['answer']) ? $data['answer'] : NULL)
            ->setUrl(isset ($data['url']) ? $data['url'] : NULL)
            ->setDate(isset ($data['date']) ? $data['date'] : NULL);
        return $validate;
    }
}