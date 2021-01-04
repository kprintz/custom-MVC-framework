<?php

namespace Controller\Database;

use Controller\Core\ControllerIndexAbstract;
use Model\Calculations\Calculations;
use Model\Calculations\CalculationsResource;
use Model\Users\UsersResource;

class Ajax extends ControllerIndexAbstract
{
    public $tableHeaders;
    public $tableRows;
    public $data;

    public function setTableHeaders($database)
    {
        $resource = new $database();
        $this->tableHeaders=$resource->getColumnNames();
        return $this;
    }

    public function setTableRows($database)
    {
        $resource = new $database();
        $this->tableHeaders=$resource->getAllData();
        return $this;
    }

    public function setData($database)
    {
        $resource = new $database();
        $this->tableHeaders=$resource->getAllData();
        return $this;
    }

    public function calculations()
    {
        $calcModel = new Calculations();
        $calcResource = new CalculationsResource();
        $this->tableRows = $calcResource->getAllData();
        $this->tableHeaders = $calcResource->getColumnNames();


        $templateModel = new \Template();
        $templateModel->setData('rows', $calcResource->getAllData());
        return $templateModel->render();

        foreach ($this->tableHeaders as $fieldName)
            $this->data[] = $fieldName . " = " . $calcModel->getData($fieldName);

        return $this->getTemplateContents([
            $this->HEADER,
            'View/templates/database_interface.phtml',
            $this->FOOTER
        ]);
    }

    public function users()
    {
        $usersResource = new UsersResource();
        $this->database = $usersResource->getAllData();
        $this->tableRows = $usersResource->getAllData();
        $this->tableHeaders = $usersResource->getColumnNames();
        return $this->getTemplateContents([
            $this->HEADER,
            'View/templates/database_interface.phtml',
            $this->FOOTER
        ]);
    }
}
