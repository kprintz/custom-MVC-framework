<?php
/**
 * @Author: katherine
 */

namespace Controller\Error;

use Controller\Core\ControllerAuthAbstract;
use View\Template;

class Index extends ControllerAuthAbstract
{
    public function execute()
    {
        return $this->routeToError('404');
    }
}
