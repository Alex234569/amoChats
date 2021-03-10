<?php

namespace application\views;

class DivToSite
{
    private ?string $error = NULL;



    public function __construct($data)
    {
        if (isset($data['error'])) {
            $this->error = $data['error'];
        } else {
            switch ($data['whatToDo']){
                case 'getInfo':
       
                case 'addInfo':
            }
        }
    }



    public static function DSerror(string $data): void
    {
        ?><div class="errorToStie">
        <?='Error: ' .$data?>
        </div><?php
    }


    public static function DSgetInfo(array $data): void
    {
        ?><div class="divToSite"><span id='boldText'>Результаты поиска:</span>
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
            </div><?php
        }
        ?>
        </div><?php
    }

    public static function DSputInfo(array $data): void
    {
        ?><div class="divToSite">
                <span id='boldText'>Добавлен вопрос</span><br />
            <div class ='result'>
                <span id='underlinedText'>Вопрос</span>: <?=$data['question']?><br />
                <span id='underlinedText'>Ответ</span>: <?=$data['answer']?><br />
                <?php if (!empty($data['url'])){ ?><span id=''><a href="<?=$data['url']?>"><?=$data['url']?></span></a><br /><?php } ?>
                <?php if (!empty($data['data'])){ ?><span id=''><?=$data['date']?></span><br /><?php } ?>
                <span id='underlinedText'>Теги</span>: <?=$data['tegs']?><br />
            </div>
        </div><?php
    }
    


}
