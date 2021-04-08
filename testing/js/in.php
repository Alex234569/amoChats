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




<a href="#" class="js-open-modal" data-modal="1">Открыть окно 1</a>
<a href="#" class="js-open-modal" data-modal="2">Открыть окно 2</a>
<a href="#" class="js-open-modal" data-modal="3">Открыть окно 3</a>

<!-- Несколько модальных окон -->

    <div class="modal" data-modal="1">
        <!--
            Кнопка закрятия, порезана
        <svg class="modal__cross js-modal-close" xmlns="http://www.w3.org/2000/svg"
             viewBox="0 0 24 24">
            <path d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z"/></svg>
        -->
    <p class="modal__title">Заголовок окна 1</p>
    </div>

    <div class="modal" data-modal="2">
        <p class="modal__title">Заголовок окна 2</p>
    </div>

    <div class="modal" data-modal="3">
        <p class="modal__title">
            Заголовок окна 3

            <form action='' id='addInfo' method = 'POST'></form>
            <label for='textareaGetInfo'></label><textarea rows='1' required form='addInfo' name='info'></textarea><br />
            <input type='submit' value='addInfoInModal' form='addInfo' name='button'>

        </p>
    </div>

    <!-- Подложка под модальным окном -->
    <div class="overlay js-overlay-modal"></div>




    </div>
    </body>
    </html>


<?php

print_r($_POST);