<?php

use app\core\Controller;
define ('DIR', $_SERVER['DOCUMENT_ROOT']);
require_once 'core/autoloader.php';



$controller = new Controller();
$controller->start();








