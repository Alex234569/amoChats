<?php

namespace app\controllers;

use app\models\validate\ValidateModel;

/**
 * Валидация и нормализация входящих данных
 * Class ValidateController
 * @package app\controllers
 */
class ValidateController
{
    /**
     * Основной контроллер валидаторов
     * @param array $data
     * @return ValidateModel
     */
    public function main(array $data): ValidateModel
    {
        if ($data['button'] == 'getInfo' || $data['button'] == 'addInfo'){
            return $this->putInfo($data);
        }
    }

    /**
     * Обработчкик поступающей информации из форм
     * @param array $data
     * @return ValidateModel
     */
    private function putInfo(array $data): ValidateModel
    {
        $validate = new ValidateModel($data['button']);
        $validate
            ->setTag($data['tag'])
            ->setQuestion(isset ($data['question']) ? $data['question'] : NULL)
            ->setAnswer(isset ($data['answer']) ? $data['answer'] : NULL)
            ->setUrl(isset ($data['url']) ? $data['url'] : NULL)
            ->setDate(isset ($data['date']) ? $data['date'] : NULL);
        return $validate;
    }
}