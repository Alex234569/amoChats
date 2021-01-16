<?php

class Validate
{
    

    public function __construct()
    {

    }


    public function validator($data)
    {
        print_r($data);

        switch($data['button']) {
            case 'getInfo':
                echo 'get';
                break;
            case 'addInfo':
                echo 'add';
                break;
        }



    }


}


