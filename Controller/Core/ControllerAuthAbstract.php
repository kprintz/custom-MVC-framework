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
        $template = new Template();
        $template->controller = "Login";
        return $template->render();


    }
}
