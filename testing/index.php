<?php



require_once "lib/main/Autoloader.php";
define ('DIR', __DIR__);


/*
spl_autoload_register(function($class) {
    $ds = DIRECTORY_SEPARATOR;
    $filename =  __DIR__ . $ds . str_replace('\\', $ds, $class) . '.php';
    print_r($filename);
    require($filename);
});
*/



use src\Foo;
use lib\Class1\Class1;
use lib\Class2\Class2;




$o1 = new Foo();
$o2 = new Class1();
$o3 = new Class2();


