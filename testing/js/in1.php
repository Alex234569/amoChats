<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset='utf-8'>
    <title>Чатики</title>
    <link href='style.css' rel='stylesheet'>
    <script src="script.js"></script>
</head>
<body>
<!--
    <div class="left">
    <div class="right">
-->
<div class="main">

    <div class="allButton">
        <a href="" class="js-open-modal" id="buttonIssue" data-modal="newIssue">Добавить новое обращение</a>
        <div class="modal" data-modal="newIssue">

            <div id="formInCenter">
                <p id='boldText'>Информация для добавления:</p>
                <form action='' id='fromAddNewIssue' method = 'POST'></form>
                <textarea id='width600pxHeight50px' placeholder='Заголовок, не более 100 символов' maxlength = '100' required form='fromAddNewIssue' name='question'></textarea><br />
                <textarea id='width600pxHeight150px' placeholder='Информация, до 10`000 символов' maxlength = '10000'  form='fromAddNewIssue' name='answer'></textarea><br />
                <input type='submit' id='bigButton' value='addInfo' form='fromAddNewIssue' name='button'>
            </div>

        </div>

        <!--  Объявление кнопки для вызова модального окна  -->
        <a href="" class="js-open-modal" id="buttonIssue" data-modal="1">Открыть окно 1</a>
        <!--  Внутренности модального окна  -->
        <div class="modal" data-modal="1">
            <p>Заголовок окна 1</p>

            <!--  Блок с формой  -->
            <div id="formInBottom">
                <!--  Объяслвение формы  -->
                <form action='' id='addInfo' method = 'POST'></form>
                <textarea id='width600pxHeight150px' placeholder='Добавление информации, до 10`000 символов' required form='addInfo' name='info'></textarea><br />

                <!--  Добавление радио для выбора от кого сообщение  -->
                <div id="radio">
                    <p><input name="radioIssue" type="radio" value="Me" form='addInfo'>Я</p>
                    <p><input name="radioIssue" type="radio" value="Int" checked form='addInfo'>Интегратор</p>
                </div>
                <!--  Кнопка  -->
                <div id="submitRadio">
                    <input type='submit' id='bigButton' value='Тыколка' form='addInfo' name='button'>
                </div>
            </div>
        </div>




        <a href="" class="js-open-modal" id="buttonIssue" data-modal="2">Открыть окно 2</a>
        <div class="modal" data-modal="2">
            <p>Заголовок окна 2</p>
        </div>

        <a href="" class="js-open-modal" id="buttonIssue" data-modal="3">Открыть окно 3</a>
        <div class="modal" data-modal="3">
            <p>
                Заголовок окна 3
            </p>
        </div>

        <a href="#" class="js-open-modal" id="buttonIssue" data-modal="4">Открыть окно 4</a>
        <a href="#" class="js-open-modal" id="buttonIssue" data-modal="5">Открыть окно 5</a>
        <a href="#" class="js-open-modal" id="buttonIssue" data-modal="6">Открыть окно 6</a>
        <a href="#" class="js-open-modal" id="buttonIssue" data-modal="7">Открыть окно 7</a>
        <a href="#" class="js-open-modal" id="buttonIssue" data-modal="8">Открыть окно 8</a>
    </div>


    <!--
            Подложка под модальным окном
                А че тут??
    -->


    <div class="overlay js-overlay-modal"></div>




</div>
</body>
</html>


