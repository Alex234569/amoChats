<?php


spl_autoload_register(function($class) {
//    print_r("<pre>" . $class . "\n" . "</pre>");
    $ds = DIRECTORY_SEPARATOR;
    $filename =  DIR . $ds . str_replace('\\', $ds, $class) . '.php';
    require($filename);
});
