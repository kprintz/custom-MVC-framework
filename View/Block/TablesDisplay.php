<?php
/**
 * @Author: katherine
 */

namespace View\Block;

class TablesDisplay extends AbstractBlock
{
    protected $template = "View/Templates/tables_display.phtml";

    public function getTableDisplay()
    {
        $route = implode('/', $this->router->getFullRoute());
        $model = explode('/', $route)[0];
        $tablesModel = '\\Model\\' . $model . '\\' . $model;
        $tablesModel = new $tablesModel();
        return $tablesModel->getResource()->getPublicColumnNames();
    }
}
