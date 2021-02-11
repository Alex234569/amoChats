<?php

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
        ?><div class="divToSite">
        <?='Error: ' .$data?>
        </div><?php
    }


    public static function DSgetInfo(array $data): void
    {
        ?><div class="divToSite">
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
                <span id=''>Вопрос: <?=$data['question']?></span><br />
                <span id=''>Ответ: <?=$data['answer']?></span><br />
                <?php if (!empty($data['url'])){ ?><span id=''><a href="<?=$data['url']?>"><?=$data['url']?></span></a><br /><?php } ?>
                <?php if (!empty($data['data'])){ ?><span id=''><?=$data['date']?></span><br /><?php } ?>
                <span id=''>Теги: <?=$data['tegs']?></span><br />
            </div>
        </div><?php
    }
    


}
