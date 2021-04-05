<?php


namespace app\controllers;

use app\models\jira\Jira;
use app\views\JiraInfo;

/**
 * Основной класс для _GET запроов, в случае, если необходимы запросы в БД
 * Class GetController
 * @package app\controllers
 */
class GetController
{

    /**
     * Основная функция GetController-a
     * @param array $data
     */
    public function main(array $data): void
    {
        switch ($data['page']) {
            case 'Jira':
                JiraInfo::display($this->getInfoForJiraCase());
        }
    }

    /**
     * Возвращается коллекция
     * @return array
     */
    public function getInfoForJiraCase(): array
    {
        $jira = new Jira();
        return $jira->main();
    }

}