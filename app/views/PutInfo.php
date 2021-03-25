<?php


namespace app\views;

/**
 * Class PutInfo, отвечает за уведомление о успешном добалвении информации в БД с тегами
 * @package app\views
 */
class PutInfo
{
    public static function putInfo(array $data): void
    {
        ?><div class="center">
            <div class="divToSite">
            <span id='boldText'>Добавлен вопрос</span><br />
                <div class ='result'>
                    <span id='underlinedText'>Вопрос</span>: <?=$data['question']?><br />
                    <span id='underlinedText'>Ответ</span>: <?=$data['answer']?><br />
                    <?php if (!empty($data['url'])){ ?><span id=''><a href="<?=$data['url']?>"><?=$data['url']?></span></a><br /><?php } ?>
                    <?php if (!empty($data['data'])){ ?><span id=''><?=$data['date']?></span><br /><?php } ?>
                    <span id='underlinedText'>Теги</span>: <?=$data['tags']?><br />
                </div>
            </div>
        </div><?php
    }
}