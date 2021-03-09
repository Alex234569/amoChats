<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/inc/logic/controller.php';;
$contoller = new Controller();

?>
<!DOCTYPE html>
<html> 
<head>
    <meta charset='utf-8'>
    <title>Чатики</title>
    <link href='../web/style.css' rel='stylesheet'>
</head>

<body>
    
<div class="header">
    	header
</div>



<div class="main">
    <div class="leftColomn">
        left
    </div>

    <div class="center">
        
        <div class="centerGetInfo">
            <p id='boldText'>Теги для запроса:</p>
            <form action='../index.php' id='tegSearch' method = 'POST'></form>
            <textarea id='textareaGetInfo' placeholder='Введите теги для поиска' rows='1' autofocus required form='tegSearch' name='getInfo'></textarea><br />
            <input type='submit' value='getInfo' form='tegSearch' name='button'>


        </div>
        <div class="centerAddInfo">
            <p id='boldText'>Информация для добавления:</p>
            <form action='../index.php' id='addInfo' method = 'POST'></form>
            <textarea id='textareaAddInfoQuestion' placeholder='Вопрос' maxlength = '1000' required form='addInfo' name='addInfoQuestion'></textarea><br />
            <textarea id='textareaAddInfoAnswer' placeholder='Ответ' maxlength = '2000' required form='addInfo' name='addInfoAnswer'></textarea><br />
            <textarea id='textareaAddInfoTegs' placeholder='Теги' maxlength = '128' required form='addInfo' name='addInfoTegs'></textarea><br />
            <textarea id='textareaAddInfoUrl' placeholder='Ссылка' maxlength = '255' form='addInfo' name='addInfoUrl'></textarea><br />
            <input type="date" form='addInfo' name='addInfoDate'><br />
            <input type='submit' value='addInfo' form='addInfo' name='button'>
            
        </div> 
        <?php
            $contoller->mainController($_POST);
        ?>

    </div>

    <div class="rightColomn">
        right
    </div>
</div>

</body>
</html>