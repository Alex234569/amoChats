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
        return $this->mainInfo($data);
    }

    /**
     * Обработчкик поступающей информации из форм
     * @param array $data
     * @return ValidateModel
     */
    private function mainInfo(array $data): ValidateModel
    {
        $validate = new ValidateModel($data['button']);
        $validate
            ->setTag($data['tag'])
            ->setQuestion($data['question'] ?? NULL)
            ->setAnswer($data['answer'] ?? NULL)
            ->setUrl($data['url'] ?? NULL)
            ->setDate($data['date'] ?? NULL);
        return $validate;
    }
}