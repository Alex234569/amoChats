<?php

namespace app\core;

use app\controllers\ValidateController;
use app\controllers\PostController;
use app\controllers\GetController;
use app\controllers\IssueController;
use app\views\Error;

/**
 * Отвечает за подключение всех остальных div, организует инициализацию бэка
 * Class Controller
 * @package app\core
 */
class Controller
{
    private ValidateController $validateController;
    private PostController $postController;
    private GetController $getController;
    private IssueController $issueController;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->validateController = new ValidateController();
        $this->postController = new PostController();
        $this->getController = new GetController();
        $this->issueController = new IssueController();
    }

    /**
     * Подключение бэка, если есть POST запрос из форм
     */
    public function start(): void
    {
        if (!empty($_GET) && $_GET['page'] === 'Jira'){
            $this->getController->main($_GET);
        }

        if (!empty($_GET) && $_GET['page'] === 'Issues'){
            $this->issueController->main();
        }

        if (isset($_POST['button'])){
            $dataAfterValidate = $this->validateController->main($_POST);
            if ($dataAfterValidate->isStop() === true) {
                Error::error($dataAfterValidate->getError());
            } else {
                $this->postController->main($dataAfterValidate);
            }
        }
    }

}