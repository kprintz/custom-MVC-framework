<?php

namespace Controller\Calculation;

use Controller\Core\ControllerAbstract;
use Model\Resource\CalculationsResource;

class Index extends ControllerAbstract
{
    public function add()
    {
        /** @var CalculationsResource $calculationModel */
        $calculationResource = new CalculationsResource();
        $calculationModel = $calculationResource->addCalculation($this->getRequest()->getIP(), $this->getRequest()->getDate(), $this->getRequest()->getPostData('calculation'));

        if ($calculationModel->getStatus()) {
            $successMessage = 'New row added. Calculation: ' . $this->getRequest()->getPostData('calculation') . ' Date: ' . $this->getRequest()->getDate() . ' IP Address: ' . $this->getRequest()->getIP();
        } else {
            $successMessage = "Data not added";
        }

        return json_encode([
            'updateStatus' => $calculationModel->getStatus(),
            'successMessage' => $successMessage,
            'allResults' => $calculationModel->getRows()
        ]);
    }

    public function update()
    {
        /** @var CalculationsResource $calculationModel */
        $calculationResource = new CalculationsResource();
        $calculationModel = $calculationResource->updateCalculation($this->getRequest()->getPostData('columnName'), $this->getRequest()->getPostData('currentValue'), $this->getRequest()->getPostData('newValue'));

        if ($calculationModel->getStatus()) {
            $successMessage = 'All rows where \'' . $this->getRequest()->getPostData('columnName') . '\' matches ' . $this->getRequest()->getPostData('currentValue') . ' have been changed to ' . $this->getRequest()->getPostData('newValue');
        } else {
            $successMessage = "Update request not completed";
        }

        return json_encode([
            'updateStatus' => $calculationModel->getStatus(),
            'successMessage' => $successMessage,
            'allResults' => $calculationModel->getRows()
        ]);
    }


    public function remove()
    {
        /** @var CalculationsResource $dbData */
        $calculationResource = new CalculationsResource();
        $calculationModel = $calculationResource->deleteCalculation(
            $this->getRequest()->getPostData('columnName'),
            $this->getRequest()->getPostData('calculation')
        );

        if ($calculationModel->getStatus()) {
            $successMessage = 'All rows where \'' . $this->getRequest()->getPostData('columnName') . '\' matches '
                . $this->getRequest()->getPostData('calculation') . ' have been deleted';
        } else {
            $successMessage = "Update request not completed";
        }

        return json_encode([
            'updateStatus' => $calculationModel->getStatus(),
            'successMessage' => $successMessage,
            'allResults' => $calculationModel->getRows(),
            //'rowsModified' => $calculationResource->getRowsChanged()
        ]);
    }

    public function getFilterData()
    {
        /** @var CalculationsResource $dbData */
        $calculationResource = new CalculationsResource();
        $calculationModel = $calculationResource->getFilteredRows($this->getRequest()->getPostData('columnName'), $this->getRequest()->getPostData('calculation'));

        if ($calculationModel->getStatus()) {
            $successMessage = 'Displaying all rows where \'' . $this->getRequest()->getPostData('columnName') . '\' is ' . $this->getRequest()->getPostData('calculation');
        } else {
            $successMessage = "There was an error";
        }

        return json_encode([
            'updateStatus' => $calculationModel->getStatus(),
            'successMessage' => $successMessage,
            'allResults' => $calculationModel->getRows()
        ]);
    }

    public function getAllData()
    {
        /** @var CalculationsResource $dbData */
        $calculationResource = new CalculationsResource();
        $calculationModel = $calculationResource->getAllCalculations();

        if ($calculationModel->getStatus()) {
            $successMessage = 'Displaying all data';
        } else {
            $successMessage = "There was an error";
        }

        return json_encode([
            'updateStatus' => $calculationModel->getStatus(),
            'successMessage' => $successMessage,
            'allResults' => $calculationModel->getRows()
        ]);
    }
}

