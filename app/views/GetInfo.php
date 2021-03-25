<?php


namespace app\views;

/**
 * Class GetInfo, отвечает за вывод информации, если она была найдена по тегам в БД
 * @package app\views
 */
class GetInfo
{
    public static function getInfo(array $data): void
    {
        ?><div class="center">
            <div class="divToSite"><span id='boldText'>Результаты поиска по тегам: <?=$data['tagsString']?></span>
            <?php
            foreach ($data['mainResult'] as $one) {
                ?><div class ='result'>
                    <div class ='resultQuestion'>
                        <span id='boldText'><?=nl2br($one['question'])?></span><br />
                    </div>
                    <div class ='resultBody'>
                        <span id=''><?=nl2br($one['answer'])?></span><br />
                        <?php if (!empty($one['url'])){ ?><span id=''><a href="<?=$one['url']?>"><?=$one['url']?></span></a><br /><?php } ?>
                        <?php if (!empty($one['date'])){ ?><span id=''><?=$one['date']?></span><br /><?php } ?>
                    </div>
                    <div class ='resultUnderInfo'>
                        <span id='italicText'>ID: <?=$one['idMain']?>, Теги: <?=$one['tag']?></span><br />
                    </div>
                </div><?php
            }
            ?>
            </div>
        </div><?php
    }
}