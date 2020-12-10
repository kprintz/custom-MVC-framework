<?php

namespace Controller\Calculation;

use Controller\Core\ControllerAbstract;
use Model\Calculations;
use Model\Resource\CalculationsResource;

class Index extends ControllerAbstract
{
    public function add()
    {
        $calcModel = new Calculations();
        $calcModel->setDate('1990-12-08');
        $calcModel->setIp('127.0.0.2');
        $calcModel->setCalculation(123456);
        $calcModel->setId(50);
        $calcModel->save();

        if ($calcModel->getStatus()) {
            $successMessage = 'New row added. Calculation: ' . $calcModel->getRow() . ' Date: ' .
                $calcModel->getData($calcModel->COL_DATE) . ' IP Address: ' .
                $calcModel->getData($calculationResource->COL_IP);
        } else {
            $successMessage = "Data not added";
        }

        return json_encode([
            'updateStatus' => $calcModel->getStatus(),
            'successMessage' => $successMessage,
            'allResults' => 'fix me', //todo needs to return all the table data
            'rowsModified' => $calculationResource->getNumberRowsLastUpdated()
        ]);
    }

    public function update()
    {
        $calcModel = new Calculations();
        $calcModel->setDate('1989-12-02');
        $calcModel->setIp('127.0.0.2');
        $calcModel->setCalculation(999);
        $calcModel->setId(3);
        $calcModel->save();

        $calcModel->load(3);
        $calcModel->getCalculation();


        if ($calcModel->getStatus()) {
            $successMessage = 'All rows where \'' . $calcModel->getData($calculationResource->COLUMN_NAME) . '\' matches ' .
                $calcModel->getData($calculationResource->FILTER_VALUE) . ' have been changed to ' .
                $calcModel->getData($calculationResource->NEW_VALUE);
        } else {
            $successMessage = "Update request not completed";
        }

        return json_encode([
            'updateStatus' => $calcModel->getStatus(),
            'successMessage' => $successMessage,
            'allResults' => $calcModel->getRow(),
            'rowsModified' => $calculationResource->getNumberRowsLastUpdated()
        ]);
    }


    public function delete()
    {
        $calcModel = new Calculations();
        $calcModel->setId(29);
        $calcModel->delete();

        return json_encode([
            'updateStatus' => '', //todo - figure out what to do with this
            'rowsUpdated' => $calcModel->getStatus() . ' rows deleted',
            'allResults' => 'fix me',
            'rowsModified' => $calculationResource->getNumberRowsLastUpdated()
        ]);
    }

    public function filter()
    {
        //todo update this and getAllData to use calcmodel - calccollections?
        /** @var CalculationsResource $dbData */
        $calculationResource = new CalculationsResource();
        $calculationModels = $calculationResource->filter([
            $calculationResource->COLUMN_NAME => $this->getRequest()->getPostData($calculationResource->COLUMN_NAME),
            $calculationResource->FILTER_VALUE => $this->getRequest()->getPostData($calculationResource->FILTER_VALUE)
        ]);

        $calcJsonData = [];
        foreach ($calculationModels as $calculationModel) {
            $calcJsonData[] = $calculationModel->getRow();
        }

        return json_encode([
            'successMessage' => 'Displaying filtered data',
            'allResults' => $calcJsonData,
            'rowsModified' => $calculationResource->getNumberRowsLastUpdated()
        ]);
    }

    public function getAllData()
    {
        /** @var CalculationsResource $dbData */
        $calculationResource = new CalculationsResource();
        $calculationModels = $calculationResource->getAllData();

        $calcJsonData = [];
        foreach ($calculationModels as $calculationModel) {
            $calcJsonData[] = $calculationModel->getRow();
        }

        return json_encode([
            'updateStatus' => $calculationResource->getNumberRowsLastUpdated(),
            'successMessage' => 'Displaying all data',
            'allResults' => $calcJsonData
        ]);
    }
}

