<?php


namespace app\views;


class Error
{
    public static function error(string $data): void
    {
        ?><div class="errorToStie">
        <?='Error: ' .$data?>
        </div><?php
    }
}