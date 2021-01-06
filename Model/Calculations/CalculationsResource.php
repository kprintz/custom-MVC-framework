<?php

namespace Model\Calculations;

use Model\AbstractResource;

class CalculationsResource extends AbstractResource
{
    public string $TABLE_NAME = 'Calculations';
    public string $COL_ID = 'id';
    public string $COL_IP = 'ip';
    public string $COL_DATE = 'date';
    public string $COL_CALCULATION = 'calculation';
    public string $COL_DELETED = 'deleted';

    public function getColumnNames()
    {
        return [
            $this->COL_ID,
            $this->COL_IP,
            $this->COL_DATE,
            $this->COL_CALCULATION,
            $this->COL_DELETED
        ];
    }

    /**
     * @param array $assocData
     * @return array
     */
    public function filter(array $assocData)
    {
        $statement = parent::filter($assocData);
        $calcModel = new Calculations();
        $calcModel->setStatus($this->rowsUpdated);

        $calcModels = [];
        while ($row = $statement->fetch()) {
            $calcModel = new Calculations();
            $calcModel->addRow($row);
            $calcModels[] = $calcModel;
        }
        return $calcModels;
    }

    /**
     * @return array
     */
    public function getAllData()
    {
        $statement = parent::getAllData();
        $calcModel = new Calculations();
        $calcModel->setStatus($this->rowsUpdated);

        $calcModels = [];
        while ($row = $statement->fetch()) {
            $calcModel = new Calculations();
            $calcModel->addRow($row);
            $calcModels[] = $calcModel;
        }
        return $calcModels;
    }
}
