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
    private MainController $mainController;
    private ValidateController $validateController;

    public function __construct()
    {
        $this->mainController = new MainController();
        $this->validateController = new ValidateController();
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