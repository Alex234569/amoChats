<?php

namespace app\core;

use app\controllers\MainController;

/**
 * Отвечает за подключение всех div, организует инициализацию бэка
 * Class Controller
 * @package app\core
 */
class Controller
{
    private MainController $mainController;

    public function __construct()
    {
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
            $this->mainController->mainController($_POST);
        }
    }

}