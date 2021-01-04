<?php

namespace Controller\Database;

use Controller\Core\ControllerIndexAbstract;

class Index extends ControllerIndexAbstract
{
    public function execute()
    {
        return $this->getTemplateContents([
            $this->HEADER,
            'View/templates/database_interface.phtml',
            $this->FOOTER
        ]);
    }
}
