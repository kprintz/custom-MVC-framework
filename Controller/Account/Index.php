<?php
/**
 * @Author: katherine
 */

namespace Controller\Account;

use Controller\Core\ControllerAuthAbstract;
use View\Template;

class Index extends ControllerAuthAbstract
{
    public function execute()
    {
        $template = new Template;
        return $template->render();
    }

    public function executePostCreation()
    {
        $template = new Template;
        return $template->render();
    }
}
