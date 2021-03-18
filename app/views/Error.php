<?php


namespace app\views;

/**
 * Class Error для вывода ошибки, если она есть
 * @package app\views
 *
 */
class Error
{
    public static function error(string $data): void
    {
        ?><div class="errorToStie">
        <?='Error: ' .$data?>
        </div><?php
    }
}