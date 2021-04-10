<?php


namespace app\views;


class BlocksAndIssues
{
    public static function showAllBlock(array $collection): void
    {
    ?>
        <div class="center">

            <!--  Для закрытия модального окна  -->
            <div class="overlay js-overlay-modal"></div>

            <!--  Добавление модального окна для добавления блоков  -->
            <div class="allButton">
                <a href="" class="js-open-modal" id="buttonIssue" data-modal="newBlock">Добавить новый блок</a>

                <!--  Внутренности окна  -->
                <div class="modal" data-modal="newBlock">
                    <div id="formInCenter">
                        <p id='boldText'>Название блока</p>
                        <form action='' id='addNewBlock' method = 'POST'></form>
                        <textarea id='width600pxHeight50px' placeholder='Заголовок, не более 100 символов' maxlength = '100' required form='addNewBlock' name='newBlockName'></textarea><br />
                        <input type='submit' id='bigButton' value='Добавить блок' form='addNewBlock' name='addNewBlock'>
                    </div>
                </div>
            </div>


                <!--  Показ всех блоков, пришедших в коллекции  -->
            <div id="">   <?php
                foreach ($collection as $item) {
                    ?>
                        <a href="index.php?page=Issues&block=<?=$item->getBlockName()?>" id="blockButton"><?=$item->getBlockName()?></a>

                    <!--
                        <form action="" id='block' method = 'GET'></form>
                        <input type='submit' value='<?=$item->getBlockName()?>' id="blockButton" form='block' name='block'>-->
                    <?php
                }   ?>
            </div>
        </div>
        <?php
    }

    public static function showAllIssues($collection)
    {
        ?>
            <div class="center">

                <!--  Для закрытия модального окна  -->
                <div class="overlay js-overlay-modal"></div>

                <!--  Добалвение модального окна для добавления обращений  -->
                <div class="allButton">
                    <a href="" class="js-open-modal" id="buttonIssue" data-modal="newIssue">Добавить новое обращение</a>

                    <!--  Внутренности окна для обращений  -->
                    <div class="modal" data-modal="newIssue">
                        <div id="formInCenter">
                            <p id='boldText'>Информация для добавления:</p>
                            <form action='' id='fromAddNewIssue' method = 'POST'></form>
                            <textarea id='width600pxHeight50px' placeholder='Заголовок, не более 100 символов' maxlength = '100' required form='fromAddNewIssue' name='caption'></textarea><br />
                            <textarea id='width600pxHeight150px' placeholder='Информация, до 10`000 символов' maxlength = '10000'  form='fromAddNewIssue' name='information'></textarea><br />
                            <input type='submit' id='bigButton' value='Добавить обращение' form='fromAddNewIssue' name='addNewIssue'>
                        </div>
                    </div>


                    <?php
                    foreach ($collection as $item) {

                    ?>


                        <!--  Объявление кнопки для вызова модального окна  -->
                        <a href="" class="js-open-modal" id="buttonIssue" data-modal="<?=$item?>"><?=$item?></a>
                        <!--  Внутренности модального окна  -->
                        <div class="modal" data-modal="<?=$item?>">
                            <p>Заголовок окна <?=$item?></p>


                            <?php

                            ?>



                            <!--  Блок с формой, отображается внизу для добавления инфомрации  -->
                            <div id="formInBottom">
                                <!--  Объявлвение формы  -->
                                <form action='' id='<?=$item?>' method = 'POST'></form>
                                <textarea id='width600pxHeight150px' placeholder='Добавление информации, до 10`000 символов' required form='<?=$item?>' name='info'></textarea><br />

                                <!--  скрытый текст для идентификации   -->
                                <textarea name="hide" form='<?=$item?>' style="display:none;">какойто текст</textarea>
                                <!--  Добавление радио для выбора от кого сообщение  -->
                                <div id="radio">
                                    <p><input name="radioIssue" type="radio" value="Me" form='<?=$item?>'>Я</p>
                                    <p><input name="radioIssue" type="radio" value="Int" checked form='<?=$item?>'>Интегратор</p>
                                </div>
                                <!--  Кнопка  -->
                                <div id="submitRadio">
                                    <input type='submit' id='bigButton' value='Тыколка' form='<?=$item?>' name='<?=$item?>'>
                                </div>
                            </div>
                        </div>
                        <?php
                    } ?>

                </div>



            </div>
        <?php
    }
}