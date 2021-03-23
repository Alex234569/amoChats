<?php
namespace app\core;

use app\controllers\Controller;
use app\views\CenterMain;
use app\views\Error404;
use app\views\ErrorCode;


class Route
{
    public static function buildRoute($path): void
    {
        if (!empty($path)) {
            switch ($path['page']) {
                case 'jira':
                    $controller = new Controller();
                    $data['getInfo'] = '-/';
                    $data['button'] = 'getInfo';
                    $controller->mainController($data);
                    break;
                case 'pact':
                    echo 'Nothing here';
                    break;
                case 'errorCode':
                    ErrorCode::codes();
                    break;
                default:
                    Error404::noPage();
            }
        } else {
            CenterMain::main();
        }
    }
}