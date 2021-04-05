<?php


namespace app\views;

use app\models\putInDB\PutterModel;

/**
 * Class PutInfo, отвечает за уведомление о успешном добалвении информации в БД с тегами
 * @package app\views
 */
class PutInfo
{
    public static function putInfo(PutterModel $data): void
    {
        ?><div class="center">
            <div class="divToSite">
            <span id='boldText'>Добавлен вопрос</span><br />
                <div class ='result'>
                    <span id='underlinedText'>Вопрос</span>: <?=$data->getQuestion()?><br />
                    <span id='underlinedText'>Ответ</span>: <?=$data->getAnswer()?><br />
                    <?php if (!empty($data->getUrl())){ ?><span id=''><a href="<?=$data->getUrl()?>"><?=$data->getUrl()?></span></a><br /><?php } ?>
                    <?php if (!empty($data->getDate())){ ?><span id=''><?=$data->getDate()?></span><br /><?php } ?>
                    <span id='underlinedText'>Теги</span>: <?=$data->getTagsString()?><br />
                </div>
            </div>
        </div><?php
    }
}