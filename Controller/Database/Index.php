<?php

namespace Controller\Database;

use Controller\Core\ControllerAuthAbstract;
use View\Template;

class Index extends ControllerAuthAbstract
{
    public function execute()
    {
        return $this->routeToLogin();
    }

    public function executePostLogin()
    {
        if (!$_SESSION || !$_SESSION['username']) {
            return 'illegal operation';
        }
        $template = new Template();
        return $template->render();
    }
}
