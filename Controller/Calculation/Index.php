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
        $calculationModel = $calculationResource->add([
            $calculationResource->COL_IP => $this->getRequest()->getIP(),
            $calculationResource->COL_DATE => $this->getRequest()->getDate(),
            $calculationResource->COL_CALCULATION => $this->getRequest()->getPostData('calculation')
        ]);

        if ($calculationModel->getStatus()) {
            $successMessage = 'New row added. Calculation: ' . $calculationModel->getRow() . ' Date: ' . $calculationModel->getData($calculationResource->COL_DATE) . ' IP Address: ' . $calculationModel->getData($calculationResource->COL_IP);
        } else {
            $successMessage = "Data not added";
        }

        return json_encode([
            'updateStatus' => $calculationModel->getStatus(),
            'successMessage' => $successMessage,
            'allResults' => 'fix me', //todo needs to return all the table data
            'rowsModified' => $calculationResource->getNumberRowsLastUpdated()
        ]);
    }

    public function update()
    {
        /** @var CalculationsResource $calculationModel */
        $calculationResource = new CalculationsResource();
        //todo - improve key name retrieval
        $calculationModel = $calculationResource->update([
            'columnName' => $this->getRequest()->getPostData('columnName'),
            'currentValue' => $this->getRequest()->getPostData('currentValue'),
            'newValue'=> $this->getRequest()->getPostData('newValue')
        ]);

        if ($calculationModel->getStatus()) {
            $successMessage = 'All rows where \'' . $calculationModel->getData('columnName') . '\' matches ' . $calculationModel->getData('currentValue') . ' have been changed to ' . $calculationModel->getData('newValue');
        } else {
            $successMessage = "Update request not completed";
        }

        return json_encode([
            'updateStatus' => $calculationModel->getStatus(),
            'successMessage' => $successMessage,
            'allResults' => 'fix me', //todo needs to return all the table data
            'rowsModified' => $calculationResource->getNumberRowsLastUpdated()
        ]);
    }


    public function delete()
    {
        /** @var CalculationsResource $calculationModel */
        $calculationResource = new CalculationsResource();
        //todo - improve key name retrieval
        $calculationModel = $calculationResource->delete([
            'columnName' => $this->getRequest()->getPostData('columnName'),
            'calculation' => $this->getRequest()->getPostData('calculation')
        ]);

        return json_encode([
            'updateStatus' => '', //todo - figure out what to do with this
            'rowsUpdated' => $calculationModel->getStatus() . ' rows deleted',
            'allResults' => 'fix me',//todo needs to return all the table data
            'rowsModified' => $calculationResource->getNumberRowsLastUpdated()
        ]);
    }

    public function filter()
    {
        /** @var CalculationsResource $dbData */
        $calculationResource = new CalculationsResource();
        $calculationModels = $calculationResource->filter([
            'columnName' => $this->getRequest()->getPostData('columnName'),
            'calculation' => $this->getRequest()->getPostData('calculation')
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

