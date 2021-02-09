<?php

$mysqli = new mysqli("localhost", "root", "root", "test");

if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}


if (!($stmt = $mysqli->prepare("INSERT INTO main (question, answer, url) VALUES (?, ?, ?)"))) {
    echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
}


$quest = 'quest';
$ans = 'ans';
$url = 'url';
if (!$stmt->bind_param("sss", $quest, $ans, $url)) {
    echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
}



if (!$stmt->execute()) {
    echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
}


