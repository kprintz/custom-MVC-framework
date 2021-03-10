<?php
/**
 * @Author: katherine
 */

namespace View\Block;

use Model\Calculations\Calculations;

class TablesForm extends AbstractBlock
{
    protected $template = "View/Templates/tables_form.phtml";

    public function getTableList()
    {
        $route = implode('/', $this->router->getFullRoute());
        $model = explode('/', $route)[0];
        $tablesModel = '\\Model\\' . $model . '\\' . $model;
        $tablesModel = new $tablesModel();
        return $tablesModel->getResource()->getPublicColumnNames();
    }
}
