<?php

namespace Controller\Homepage;

use Controller\Core\ControllerIndexAbstract;
use View\Template;

class Index extends ControllerIndexAbstract
{
    public function execute()
    {
        $template = new Template;
        return $template->render();
    }
}
