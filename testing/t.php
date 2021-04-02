<?php


$host = 'localhost';
$db   = 'chats';
$user = 'root';
$pass = 'root';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
/*
$numberParams = '?';
$query = "SELECT main.id_main, main.question, main.answer, main.url, main.date FROM main 
            LEFT JOIN compound ON main.id_main = compound.id_main 
            LEFT JOIN tegs ON compound.id_teg = tegs.id_teg 
            WHERE tegs.teg IN ($numberParams) GROUP BY main.id_main HAVING (COUNT(*) = ?)";


$a = '1';
$b = 'англ';



$stmt = $pdo->prepare($query);
$stmt->execute(array($b, $a));

while ($row = $stmt->fetch(PDO::FETCH_LAZY))
{
    $one['idMain'] = $row['id_main'];
    $one['question'] = $row['question'];
    $one['answer'] = $row['answer'];
    $one['url'] = $row['url'];
    $one['date'] = $row['date'];
    $result[] = $one;
}
print_r($result);
*/


$numberParams = '?, ?';
$query = "SELECT main.id_main, main.question, main.answer, main.url, main.date FROM main 
            LEFT JOIN compound ON main.id_main = compound.id_main 
            LEFT JOIN tegs ON compound.id_teg = tegs.id_teg 
            WHERE tegs.teg IN ($numberParams) GROUP BY main.id_main HAVING (COUNT(*) = ?)";


$a = '2';

$b = 'тех';
$bb = 'акк';
$q = ['тех', 'акк'];

//$arr = array($bb, $b, $a);

$arr = [];
foreach ($q as $one1){
    $arr[] = $one1;
}
$arr[] = $a;
print_r($arr);

$stmt = $pdo->prepare($query);
$stmt->execute($arr);
/*
while ($row = $stmt->fetch(PDO::FETCH_LAZY))
{
    $one['idMain'] =  $row['id_main'];
    $one['question'] =  $row['question'];
    $one['answer'] = $row['answer'];
    $one['url'] = $row['url'];
    $one['date'] = $row['date'];
    $result[] = $one;
}
print_r($result);


*/

