<?php

namespace Model\Resource;

use DB\Core\DbConnect;
use Model\Calculations;

class CalculationsResource extends AbstractResource
{
    public string $TABLE_NAME = 'Calculations';
    public string $COL_ID = 'ID';
    public string $COL_IP = 'ip';
    public string $COL_DATE = 'date';
    public string $COL_CALCULATION = 'calculation';

    public function getColumnNames()
    {
        return [
            $this->COL_ID,
            $this->COL_IP,
            $this->COL_DATE,
            $this->COL_CALCULATION,
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
     * @return Calculations[]
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
