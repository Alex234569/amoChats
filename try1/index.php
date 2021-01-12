<?php 

include_once 'data.php';
include_once 'form.php';

echo "<pre>";

//$together = array_merge($questions, $answers, $url);

$together = [];
$together[] = $questions;
$together[] = $answers;
$together[] = $url;


//print_r($together);

//echo ($_POST['question']);

if (isset($_POST['question']) && isset($_POST['answer']) && isset($_POST['url']) && isset($_POST['tegs'])){
    echo 'nice';


} else {
    echo 'Не заполнены все поля';
}



