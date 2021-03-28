<?php


namespace app\models\validate;

use app\models\validate\Val;

class Getter
{
    private Val $validate;
    public function __construct()
    {
        $this->validate = new Val();
    }

    public function main(array $data)
    {
    print_r($data);
    // если будет пустой параметр то будет плохо. Есть смысл передать его целиком, распарсить на стороне Val и
        // потом уже вызывать нужные функции для изменения данных
     /*  $this->validate
            ->tag($data['getInfo'])
            ->question()
            ->answer()
            ->url()
            ->date();
 */



     }
}