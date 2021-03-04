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
        $template = new Template("Login");
        return $template->render();
    }

    public function routeToError()
    {
        $template = new Template("Error");
        return $template->render();
    }
}
