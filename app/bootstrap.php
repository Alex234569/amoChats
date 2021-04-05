<?php

use app\core\Controller;
use app\core\Route;

define ('DIR', $_SERVER['DOCUMENT_ROOT']);
require_once 'core/autoloader.php';
require_once DIR . "/app/views/Template.php";  // подключение освного каркаса страницы


Route::buildRoute($_GET);


//    echo "<pre>";
//    echo "<div class='center'>";


$controller = new Controller();
$controller->start();








