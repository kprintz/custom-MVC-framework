<?php

namespace Controller\Calculation;

use Model\Resource\CalculationsResource;
use Model\CalculationsData;

class Index
{
    public function add()
    {
        $postData = new CalculationsData();
        $postData->setIP();
        $postData->setDate();
        $postData->setData($_POST);

        /** @var CalculationsResource $calculationModel */
        $calculationResource = new CalculationsResource();
        $calculationModel = $calculationResource->addCalculation($postData->getIP(), $postData->getDate(), $postData->getCalculation());

        if ($calculationModel->getStatus()) {
            $successMessage = 'New row added. Calculation: ' . $postData->getCalculation() . ' Date: ' . $postData->getDate() . ' IP Address: ' . $postData->getIP();
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
        //todo turn this into a class/interface or something
        $postData = new CalculationsData();
        $postData->setData($_POST);

        $calculationResource = new CalculationsResource();
        $calculationModel = $calculationResource->updateCalculation($postData->getColumn(), $postData->getCurrentValue(), $postData->getNewValue());

        if ($calculationModel->getStatus()) {
            $successMessage = 'All rows where \'' . $postData->getColumn() . '\' matches ' . $postData->getCurrentValue() . ' have been changed to ' . $postData->getNewValue();
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
        $postData = new CalculationsData();
        $postData->setData($_POST);

        /** @var CalculationsResource $dbData */
        $calculationResource = new CalculationsResource();
        $calculationModel = $calculationResource->deleteCalculation($postData->getColumn(), $postData->getCalculation());

        if ($calculationModel->getStatus()) {
            $successMessage = 'All rows where \'' . $postData->getColumn() . '\' matches ' . $postData->getCalculation() . ' have been deleted';
        } else {
            $successMessage = "Update request not completed";
        }

        return json_encode([
            'updateStatus' => $calculationModel->getStatus(),
            'successMessage' => $successMessage,
            'allResults' => $calculationModel->getRows()
        ]);
    }

    public function getFilterData()
    {
        $postData = new CalculationsData();
        $postData->setData($_POST);

        /** @var CalculationsResource $dbData */
        $calculationResource = new CalculationsResource();
        $calculationModel = $calculationResource->getFilteredRows($postData->getColumn(), $postData->getCalculation());

        if ($calculationModel->getStatus()) {
            $successMessage = 'Displaying all rows where \'' . $postData->getColumn() . '\' is ' . $postData->getCalculation();
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