<?php

namespace Controller\Database;

use Controller\Core\ControllerAuthAbstract;
use View\Template;

class Index extends ControllerAuthAbstract
{
    public function execute()
    {
        if ($_SESSION) {
            session_unset();
        }
        return $this->routeToLogin();
    }

    public function executePostLogin()
    {
        if (!$_SESSION || !$_SESSION['username']) {
            return 'illegal operation';
        }
        $template = new Template();
        $template->setData('username', $_SESSION['username']);
        return $template->render();
    }
}
