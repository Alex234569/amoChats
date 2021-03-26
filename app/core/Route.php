<?php
namespace app\core;

use app\controllers\MainController;

/**
 * Class Route, отвечает за подключение страниц
 * @package app\core
 */
class Route
{
    /**
     * Подключаем нужные div в зависимости от GET парамтера, получаемого с кнопок
     * @param array $get
     */
    public static function buildRoute(array $get): void
    {
        if (!empty($get)) {
            switch ($get['page']) {
                case 'Jira':
                    $controller = new MainController();
                    $data['getInfo'] = '-/';
                    $data['button'] = 'getInfo';
                    $controller->mainController($data);
                    break;
                case 'ErrorCode':
                    require_once DIR . '/app/views/ErrorCode.php';
                    break;
                default:
                    require_once DIR . '/app/views/Error404.php';
            }
        } else {
            require_once DIR . '/app/views/CenterMain.php';
        }
    }
}