<?php

namespace app\views;

use app\controllers\Controller;


class CenterMain
{
    public static function main()
    {
        ?>
            <div class="centerGetInfo">
                <p id='boldText'>Теги для запроса:</p>
                <form action='../../../index.php' id='tagSearch' method = 'POST'></form>
                <label for='textareaGetInfo'></label><textarea id='textareaGetInfo' placeholder='Введите теги для поиска' rows='1' autofocus required form='tagSearch' name='getInfo'></textarea><br />
                <input type='submit' value='getInfo' form='tagSearch' name='button'>
            </div>

            <div class="centerAddInfo">
                <p id='boldText'>Информация для добавления:</p>
                <form action='../../../index.php' id='addInfo' method = 'POST'></form>
                <label for='textareaAddInfoQuestion'></label><textarea id='textareaAddInfoQuestion' placeholder='Вопрос' maxlength = '1000' required form='addInfo' name='addInfoQuestion'></textarea><br />
                <label for='textareaAddInfoAnswer'></label><textarea id='textareaAddInfoAnswer' placeholder='Ответ' maxlength = '2000' required form='addInfo' name='addInfoAnswer'></textarea><br />
                <label for='textareaAddInfoTags'></label><textarea id='textareaAddInfoTags' placeholder='Теги' maxlength = '128' required form='addInfo' name='addInfoTags'></textarea><br />
                <label for='textareaAddInfoUrl'></label><textarea id='textareaAddInfoUrl' placeholder='Ссылка' maxlength = '255' form='addInfo' name='addInfoUrl'></textarea><br />
                <label>
                    <input type="date" form='addInfo' name='addInfoDate'>
                </label><br />
                <input type='submit' value='addInfo' form='addInfo' name='button'>
            </div>
        <?php
        $controller = new Controller();
        $controller->mainController($_POST);
    }
}