<?php
/**
 * @Author: katherine
 */

namespace View\Block;

use Model\Calculations\Calculations;
use Model\Users\Users;

class TablesDisplay extends AbstractBlock
{
    protected $template = "View/Templates/tables_display.phtml";

    public function getColumnNames()
    {
        $route = implode('/', $this->router->getFullRoute());
        $model = $route[0];
        $model = new $model[0]();
        return $model->getResource()->getPublicColumnNames();
    }
}
