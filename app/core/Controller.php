<?php

namespace app\core;

use app\controllers\MainController;
use app\controllers\ValidateController;

/**
 * Отвечает за подключение всех div, организует инициализацию бэка
 * Class Controller
 * @package app\core
 */
class Controller
{
    private ValidateController $validateController;
    private MainController $mainController;

    public function __construct()
    {
        $this->validateController = new ValidateController();
        $this->mainController = new MainController();
        require_once DIR . "/app/views/Template.php";
        Route::buildRoute($_GET);
    }

    /**
     * Подключение бэка, если есть POST запрос из форм
     */
    public function start(): void
    {
        if (!empty($_POST)){
            $dataAfterValidate = $this->validateController->main($_POST);
            $this->mainController->mainController($dataAfterValidate);
        }
    }

}