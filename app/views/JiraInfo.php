<?php


namespace app\views;

class JiraInfo
{
    public static function display(array $collection): void
    {
        ?><div class="center">
            <h2>Тикеты</h2><?php
        foreach ($collection as $item) {
            ?>
            <div class ='errorCodeBlock'>
                <div class ='littleHeader'>
                    <span id='boldText'><?=nl2br($item->getQuestion())?></span><br />
                </div>
                <span id=''><a href="<?=$item->getAnswer()?>"><?=$item->getAnswer()?></a></span>
            </div>
        <?php
        }
    }
}