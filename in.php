<?php

include_once '';




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

        print_r($res);

/*
$test = 'https://test.com';
     $a = filter_var($test, FILTER_VALIDATE_URL);

        if(filter_var($test, FILTER_VALIDATE_URL) !=false){
            var_dump($a);
        } else {
            echo 'no';
        }

        
*/
