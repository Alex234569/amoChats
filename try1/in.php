<?php

include_once 'controller.php';
include_once 'infoFromDB.php';
include_once 'infoToDB.php';
include_once 'db.php';
//include_once 'mainData.php';


$askArray = [
//    'человек',
    'говорить',
    'животное',
//    'елка',
];


$putArray1 = [
        'question' => 'QTest1',
        'answer' => 'ATest11',
        'url' => 'UTest1',
        'data' => '2003.05.21',
        'tegs' => ['ч1еловек', 'г1оворить']
];

$putArray2 = [
        'question' => 'QTest2',
        'answer' => 'ATest2',
        'tegs' => ['человек', 'говорить']
];


$controller = new Controller();


//  вывод инфомации
        $res = $controller->dataFromDB($askArray);
//        print_r($res);


//$controller->dataToDB($putArray2);

//  ввод информации

