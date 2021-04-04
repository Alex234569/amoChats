<?php

namespace app\core;

use app\controllers\MainController;
use app\controllers\ValidateController;
use app\views\Error;

/**
 * Отвечает за подключение всех остальных div, организует инициализацию бэка
 * Class Controller
 * @package app\core
 */
class Controller
{
    private ValidateController $validateController;
    private MainController $mainController;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->validateController = new ValidateController();
        $this->mainController = new MainController();
    }

    /**
     * Подключение бэка, если есть POST запрос из форм
     */
    public function start(): void
    {
        if (!empty($_POST)){
            $dataAfterValidate = $this->validateController->main($_POST);
            if ($dataAfterValidate->isStop() === true) {
                Error::error($dataAfterValidate->getError());
            } else {
                $this->mainController->mainController($dataAfterValidate);
            }
        }
    }

}