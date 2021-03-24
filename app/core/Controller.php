<?php

namespace app\core;

use app\controllers\MainController;
use app\core;

class Controller
{
    private View $view;
    private Route $route;
    private MainController $mainController;

    public function __construct()
    {
    //    $this->view = new View();
    //    $this->route = new Route();
        $this->mainController = new MainController();
    }

    public function start()
    {
        require_once DIR . "/app/views/Template.php";
        print_r($_POST);
        print_r($_GET);
        if (!empty($_POST)){
            $this->mainController->mainController($_POST);
        } else {
            echo 'nope';
        }
    }

}