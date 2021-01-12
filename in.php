<?php

include_once 'inc/controller.php';




[
//    'человек',
//    'говорить',
//    'животное',
//    'елка',
    'патисон',
];

$askArray = 'говорить';

$putArray1 = [
        'addInfoQuestion' => 'QTest1',
        'addInfoAnswer' => 'ATest11',
        'addInfoUrl' => 'UTest1',
        'addInfoDate' => '2003-05-21',
        'addInfoTegs' => "кабачок патисон"
];

$putArray2 = [
        'addInfoQuestion' => 'QTest2',
        'addInfoAnswer' => 'ATest2',
        'addInfoTegs' => ['человек', 'говорить']
];


$controller = new Controller();


//  вывод инфомации
        $res = $controller->getFromDB($askArray);




//  ввод информации
//        $controller->putInDB($putArray1);



