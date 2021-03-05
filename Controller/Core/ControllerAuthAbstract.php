<?php
/**
 * @Author: katherine
 */

namespace Controller\Core;

use View\Template;

abstract class ControllerAuthAbstract extends ControllerIndexAbstract
{
    public function routeToLogin()
    {
        $template = new Template('Login/Index/execute');
        return $template->render();
    }

    public function routeToError()
    {
        $template = new Template("Error");
        return $template->render();
    }
}
