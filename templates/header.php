<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/inc/controller.php';;
$contoller = new Controller();

?>
<!DOCTYPE html>
<html> 
<head>
    <meta charset='utf-8'>
    <title>Чатики</title>
    <link href='../style.css' rel='stylesheet'>
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
            <input type='submit' value='Тыкалка' form='tegSearch'>


        </div>
        <div class="centerAddInfo">
            <p id='boldText'>Информация для добавления:</p>
            <form action='../index.php' id='addInfo' method = 'POST'></form>
            <textarea id='textareaAddInfoQuestion' placeholder='Вопрос' maxlength = '1000' required form='addInfo' name='addInfoQuestion'></textarea><br />
            <textarea id='textareaAddInfoAnswer' placeholder='Ответ' maxlength = '2000' required form='addInfo' name='addInfoAnswer'></textarea><br />
            <textarea id='textareaAddInfoTegs' placeholder='Теги' maxlength = '128' required form='addInfo' name='addInfoTegs'></textarea><br />
            <textarea id='textareaAddInfoUrl' placeholder='Ссылка' maxlength = '255' form='addInfo' name='addInfoUrl'></textarea><br />
            <input type="date" form='addInfo' name='addInfoDate'><br />
            <input type='submit' value='Тыкалка' form='addInfo'>
            
        </div> 
        <?php
        if ((isset($_POST['addInfoQuestion']) && isset($_POST['addInfoAnswer'])) || (isset($_POST['getInfo']))) { ?>
            <div class="centerAnswer">
            <?php
            if (isset($_POST['addInfoQuestion']) && isset($_POST['addInfoAnswer'])){
                $result = $contoller->putInDB($_POST); ?>
                <span id='boldText'>Добавлен вопрос: </span><?=$result['question']?><br />
                <span id='boldText'>С ответом: </span><?=$result['answer']?><br /> 
                <span id='boldText'>С тегами: </span><?=$result['tegs']?><br /> 
                <?php
            } elseif (isset($_POST['getInfo'])){
                $result = $contoller->getFromDB($_POST['getInfo']); ?>
                <span id='boldText'>Теги для поиска: </span><?=$result['tegs']?><br /><hr>
                <?php
                if ($result['main'][0] == 'nothing') { ?>
                    Данных с такими тегами нет. <?php
                } else {
                    foreach ($result['main'] as $key => $res){ ?>
                    <span id='boldText' id='underlinedText'>Вопрос: </span><span id='underlinedText'><?=nl2br($res['question'])?></span><br />
                    <span id='boldText'>Ответ: </span><?=nl2br($res['answer'])?><br />
                    <?php if (!empty($res['url'])) { ?>
                        <span id='boldText'>Ссылка: </span><a href="<?=$res['url']?>"><?=$res['url']?></a><br />
                    <?php } if (!empty($res['date'])) { ?>
                        <span id='boldText'>Дата: </span><?=$res['date']?><br />
                    <?php } ?><hr>
                    <?php
                    }
                }
            } ?>
            </div> <?php 
        } ?>

    </div>

    <div class="rightColomn">
        right
    </div>
</div>










</body>
</html>