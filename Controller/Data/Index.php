<?php

namespace Controller\Data;

use Controller\Core\ControllerIndexAbstract;
use Model\Resource\CalculationsResource;

class Index extends ControllerIndexAbstract
{
    public $tableHeaders;
    public $calcModels;

    public function execute()
    {
        $calcRes = new CalculationsResource();
        $this->calcModels = $calcRes->getAllData();
        $this->tableHeaders = $calcRes->getColumnNames();
        return $this->getTemplateContents([
            $this->HEADER,
            'View/templates/database_interface.phtml',
            $this->FOOTER
        ]);
    }
}
