<?php


namespace Controller\Users;

use Controller\Core\ControllerIndexAbstract;
use View\Template;

class Index extends ControllerIndexAbstract
{
    public function execute()
    {
        $template = new Template;
        return $template->render([
            $this->HEADER,
            'View/templates/database_interface.phtml',
            $this->FOOTER
        ]);
    }
}
