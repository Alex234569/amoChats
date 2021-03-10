<?php
/*
include 'logic.php';
include 'db.php';

$boo = new Boo();
$boo->start();
*/

$a = [
    1,
    2,
    3
];

$num = count($a);

$q = '(';
for ($w = 0; $w < $num; $w++){
    $q .= '?, ';
}


$qwe = mb_substr($q, -0, -2) . ')';
print_r($qwe);