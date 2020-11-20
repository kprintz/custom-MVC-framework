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
            $calculationResource->COL_CALCULATION => $this->getRequest()->getPostData($calculationResource->COL_CALCULATION)
        ]);

        if ($calculationModel->getStatus()) {
            $successMessage = 'New row added. Calculation: ' . $calculationModel->getRow() . ' Date: ' .
                $calculationModel->getData($calculationResource->COL_DATE) . ' IP Address: ' .
                $calculationModel->getData($calculationResource->COL_IP);
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

        $calculationModel = $calculationResource->update([
            $calculationResource->COLUMN_NAME => $this->getRequest()->getPostData($calculationResource->COLUMN_NAME),
            $calculationResource->FILTER_VALUE => $this->getRequest()->getPostData($calculationResource->FILTER_VALUE),
            $calculationResource->NEW_VALUE => $this->getRequest()->getPostData($calculationResource->NEW_VALUE)
        ]);

        if ($calculationModel->getStatus()) {
            $successMessage = 'All rows where \'' . $calculationModel->getData($calculationResource->COLUMN_NAME) . '\' matches ' .
                $calculationModel->getData($calculationResource->FILTER_VALUE) . ' have been changed to ' .
                $calculationModel->getData($calculationResource->NEW_VALUE);
        } else {
            $successMessage = "Update request not completed";
        }

        return json_encode([
            'updateStatus' => $calculationModel->getStatus(),
            'successMessage' => $successMessage,
            'allResults' => serialize($calculationModel->getRow()),
            'rowsModified' => $calculationResource->getNumberRowsLastUpdated()
        ]);
    }


    public function delete()
    {
        /** @var CalculationsResource $calculationModel */
        $calculationResource = new CalculationsResource();
        $calculationModel = $calculationResource->delete([
            $calculationResource->COLUMN_NAME => $this->getRequest()->getPostData($calculationResource->COLUMN_NAME),
            $calculationResource->FILTER_VALUE => $this->getRequest()->getPostData($calculationResource->FILTER_VALUE)
        ]);

        return json_encode([
            'updateStatus' => '', //todo - figure out what to do with this
            'rowsUpdated' => $calculationModel->getStatus() . ' rows deleted',
            'allResults' => 'fix me',
            'rowsModified' => $calculationResource->getNumberRowsLastUpdated()
        ]);
    }

    public function filter()
    {
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

