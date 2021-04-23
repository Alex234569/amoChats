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
                <a href="" class="js-open-modal" id="buttonNewBlock" data-modal="newBlock">
                    <img src="../../images/whitePlus-blackCircle.svg"  width="100%" height="100%">
                </a>

                <!--  Внутренности окна  -->
                <div class="modal" data-modal="newBlock">
                    <div id="formInCenter">
                        <p id='boldText'>Название блока</p>
                        <form action='' id='addNewBlock' method = 'POST'></form>
                        <textarea id='width600pxHeight50px' placeholder='Заголовок, не более 100 символов' maxlength = '100' required form='addNewBlock' name='newBlockName'></textarea><br />
                        <input type='submit' id='bigButton' value='Добавить' form='addNewBlock' name='addNewBlock'>
                    </div>
                </div>
            </div>

                <!--  Показ всех блоков, пришедших в коллекции  -->
            <div id="">   <?php
                foreach ($collection as $item) {
                    ?>
                        <a href="index.php?page=Issues&block=<?=$item->getBlockName()?>" id="allBlocks"><?=$item->getBlockName()?></a>
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


                <!--  Пошла, Плотва!  -->
                <div class="allButton">
                    <!--  Возврат на предыдущую страницу (удобно же ж)  -->
                    <a href="index.php?page=Issues" id="buttonNewIssue">
                        <img src="../../images/left-arrow.svg"  width="100%" height="100%">
                    </a>

                    <!--  Модальное окно для добавления обращений  -->
                    <a href="" class="js-open-modal" id="buttonNewIssue" data-modal="newIssue">
                        <img src="../../images/blackPlus-whiteCircle.svg"  width="100%" height="100%">
                    </a>
                    <!--  Внутренности окна для обращений  -->
                    <div class="modal" data-modal="newIssue">
                        <div id="formInCenter">
                            <p id='boldText'>Информация для добавления:</p>
                            <form action='' id='fromAddNewIssue' method = 'POST'></form>
                            <textarea id='width600pxHeight50px' placeholder='Заголовок, не более 100 символов' maxlength = '100' required form='fromAddNewIssue' name='caption'></textarea><br />
                            <textarea id='width600pxHeight150px' placeholder='Информация, до 10`000 символов' maxlength = '10000'  form='fromAddNewIssue' name='text'></textarea><br />
                            <input type='submit' id='bigButton' value='Добавить' form='fromAddNewIssue' name='addNewIssue'>
                        </div>
                    </div>
                    <?php
                    foreach ($collection as $item) {
                        $issueCaption = $item->getCaption();
                    ?>
                        <!--  Объявление кнопки для вызова модального окна  -->
                        <a href="" class="js-open-modal" id="buttonIssue" data-modal="<?=$issueCaption?>"><?=$issueCaption?></a>
                        <!--  Внутренности модального окна  -->
                        <div class="modal" data-modal="<?=$issueCaption?>">
                            <h3><?=$issueCaption?></h3>


                            <?php
                                /*  Тут выводятся все сообщения, которые есть в данном обращении  */
                            foreach ($item->getMessageModel() as $oneMessage) {
                                $from = $oneMessage->getFrom() === 0 ? 'интегратора' : 'меня';
                                if ($from === 'интегратора') {  ?>
                                    <div id='message' style="text-align: left">
                                        <p><?=nl2br($oneMessage->getText())?></p>
                                        <div id ='infoUnderMessage'>
                                            <span id='italicText'>От: <?=$from?>, Время: <?=$oneMessage->getDate()?></span><br />
                                        </div>
                                    </div>
                                <?php  } else {  ?>
                                    <div id='message'style="text-align: right">
                                        <p><?=nl2br($oneMessage->getText())?></p>
                                        <div id ='infoUnderMessage'>
                                            <span id='italicText'>От: <?=$from?>, Время: <?=$oneMessage->getDate()?></span><br />
                                        </div>
                                    </div>
                                <?php }
                            }  ?>

                            <!--  Блок с формой, отображается внизу для добавления инфомрации  -->
                            <div id="formInBottom">
                                <!--  Объявлвение формы  -->
                                <form action='' id='<?=$issueCaption?>' method = 'POST'></form>
                                <textarea id='width600pxHeight150px' placeholder='Добавление информации, до 10`000 символов' required form='<?=$issueCaption?>' name='text'></textarea><br />

                                <!--  скрытый текст для идентификации   -->
                                <textarea name="issue" form='<?=$issueCaption?>' style="display:none;"><?=$issueCaption?></textarea>
                                <!--  Добавление радио для выбора от кого сообщение  -->
                                <div id="radio">
                                    <p><input name="radioIssue" type="radio" value="me" form='<?=$issueCaption?>'>Я</p>
                                    <p><input name="radioIssue" type="radio" value="integrator" checked form='<?=$issueCaption?>'>Интегратор</p>
                                    <p><input name="checkboxIssue" type="checkbox" form='<?=$issueCaption?>'>Закрыть обращение</p>
                                </div>
                                <!--  Кнопка  -->
                                <div id="submitRadio">
                                    <input type='submit' id='bigButton' value='Тыколка' form='<?=$issueCaption?>' name='addNewMessage'>
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