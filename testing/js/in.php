<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset='utf-8'>
    <title>Чатики</title>
    <link href='style.css' rel='stylesheet'>
    <script src="http://code.jquery.com/jquery-2.0.2.min.js"></script>
    <script src="script.js"></script>
</head>
<body>
<!--
    <div class="left">
    <div class="right">
-->
<div class="main">
    <div class="little">Текст1</div>
    <div class="little">Текст2</div>


    <!--
        <div class="little">
            Текст3
            <a href="javascript:PopUpShow(1)">Show popup1</a>
        </div>
        <div class="popup" id="popup1">
            <div class="popup-content">
                Text in Popup1
                <a href="javascript:PopUpHide(1)">Hide popup1</a>
            </div>
        </div>


        <div class="little">
            Sample Text
            <a href="javascript:PopUpShow(2)">Show popup2</a>
        </div>
        <div class="popup" id="popup2">
            <div class="popup-content">
                Text in Popup2
                <a href="javascript:PopUpHide(2)">Hide popup2</a>
            </div>
        </div>
    -->
<!-- Элементы для вызова модальных окон, могут быть любые -->

<a href="#" class="js-open-modal" data-modal="1">Открыть окно 1</a>
<a href="#" class="js-open-modal" data-modal="2">Открыть окно 2</a>
<a href="#" class="js-open-modal" data-modal="3">Открыть окно 3</a>

<!-- Несколько модальных окон -->

    <div class="modal" data-modal="1">
    <p class="modal__title">Заголовок окна 1</p>
    </div>

    <div class="modal" data-modal="2">
        <p class="modal__title">Заголовок окна 2</p>
    </div>

    <div class="modal" data-modal="3">
        <p class="modal__title">Заголовок окна 3</p>
    </div>

    <!-- Подложка под модальным окном -->
    <div class="overlay js-overlay-modal"></div>




    </div>
    </body>
    </html>