<?php

namespace Controller\Homepage;

use Controller\Core\ControllerIndexAbstract;

class Index extends ControllerIndexAbstract
{

    public function execute()
    {
        return $this->getTemplateContents([
            $this->HEADER,
            'View/templates/index.phtml',
            $this->FOOTER
        ]);
    }
}
