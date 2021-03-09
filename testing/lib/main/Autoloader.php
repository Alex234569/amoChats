<?php


spl_autoload_register(function($class) {
    $ds = DIRECTORY_SEPARATOR;
    $filename =  DIR . $ds . str_replace('\\', $ds, $class) . '.php';
    require($filename);
});
