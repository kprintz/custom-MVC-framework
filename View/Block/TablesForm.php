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
        $calcModel= new Calculations();
        return $calcModel->getResource()->getPublicColumnNames();
    }
}
