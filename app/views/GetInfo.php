<?php


namespace app\views;

use app\models\getFromDB\GetterModel;

/**
 * Class GetInfo, отвечает за вывод информации, если она была найдена по тегам в БД
 * @package app\views
 */
class GetInfo
{
    public static function getInfo(GetterModel $data): void
    {
        $collection = $data->getCollection();

        ?><div class="center">
            <div class="divToSite"><span id='boldText'>Результаты поиска по тегам: <?=$data->getTagsString()?></span>
            <?php
            foreach ($collection as $item) {
                ?><div class ='result'>
                    <div class ='resultQuestion'>
                        <span id='boldText'><?=nl2br($item->getQuestion())?></span><br />
                    </div>
                    <div class ='resultBody'>
                        <span id=''><?=nl2br($item->getAnswer())?></span><br />
                        <?php if (!empty($item->getUrl())){ ?><span id=''><a href="<?=$item->getUrl()?>"><?=$item->getUrl()?></span></a><br /><?php } ?>
                        <?php if (!empty($item->getDate())){ ?><span id=''><?=$item->getDate()?></span><br /><?php } ?>
                    </div>
                    <div class ='resultUnderInfo'>
                        <span id='italicText'>ID: <?=$item->getIdMain()?>, Теги: <?=$item->getTagString()?></span><br />
                    </div>
                </div><?php
            }
            ?>
            </div>
        </div><?php
    }
}