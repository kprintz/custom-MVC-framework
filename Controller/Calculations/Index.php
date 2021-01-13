<?php

namespace Controller\Calculations;

use Controller\Core\ControllerIndexAbstract;
use View\Template;

class Index extends ControllerIndexAbstract
{
    public function execute()
    {
        //todo need to update how this works - just added templates here for testing (tables_form and table_display)
        $template = new Template;
        return $template->render([
            $this->HEADER,
            'View/templates/database_interface.phtml',
            'View/templates/table_display.phtml',
            $this->FOOTER
        ]);
    }
}
