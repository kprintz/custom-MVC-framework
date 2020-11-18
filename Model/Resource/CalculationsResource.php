<?php

namespace Model\Resource;

use DB\Core\DbConnect;
use Model\Calculations;

class CalculationsResource extends DbConnect
{
    const TABLE_NAME = 'Calculations';
    const COL_IP = 'ip';
    const COL_DATE = 'date';
    const COL_CALCULATION = 'calculation';

    /**
     * @param $ip
     * @param $date
     * @param $calculation
     * @return Calculations
     */
    public function addCalculation($ip, $date, $calculation)
    {
        $sql = 'INSERT INTO ' . $this::TABLE_NAME . ' (' . $this::COL_IP . ', ' . $this::COL_DATE . ', ' . $this::COL_CALCULATION . ') VALUES (?,?,?)';
        $stmt = $this->connect()->prepare($sql);

        $dbData = new Calculations();
        $dbData->setStatus($stmt->execute([$ip, $date, $calculation]));
        $dbData->addRow([]);

        return $dbData;
    }

    /**
     * @param string $column
     * @param null $currentValue
     * @param null $newValue
     * @return Calculations
     */
    public function updateCalculation($column = 'calculation', $currentValue = null, $newValue = null)
    {
        $sql = 'UPDATE ' . $this::TABLE_NAME . ' SET ' . $column . ' = \'' . $newValue . '\'  WHERE ' . $column . ' = \'' . $currentValue . '\'';
        $stmt = $this->connect()->prepare($sql);

        $dbData = new Calculations();
        $dbData->setStatus($stmt->execute());
        $dbData->addRow([]);

        return $dbData;
    }

    /**
     * @param $column
     * @param null $value
     * @return Calculations
     */
    public function deleteCalculation($column, $value = null)
    {
        $sql = 'DELETE FROM ' . $this::TABLE_NAME . ' WHERE ' . $column . ' = \'' . $value . '\'';
        $stmt = $this->connect()->prepare($sql);

        $dbData = new Calculations();
        $dbData->setStatus($stmt->execute());
        $dbData->addRow([]);
        //todo implement row counts on resource
        //todo this data should be on a parent class (common to all resource models)
        //$this->rowsChanged = $stmt->rowCount();

        return $dbData;
    }

    /**
     * @param $column
     * @param $value
     * @return Calculations
     */
    public function getFilteredRows($column, $value)
    {
        $sql = 'SELECT * FROM ' . $this::TABLE_NAME . ' WHERE ' . $column . ' = \'' . $value . '\'';

        $stmt = $this->connect()->prepare($sql);

        $dbData = new Calculations();
        $dbData->setStatus($stmt->execute());
        while ($row = $stmt->fetch()) {
            $dbData->addRow($row);
        }
        return $dbData;
    }

    public function getAllCalculations()
    {
        $sql = 'SELECT * FROM ' . $this::TABLE_NAME;

        $stmt = $this->connect()->prepare($sql);

        $dbData = new Calculations();
        $dbData->setStatus($stmt->execute());
        while ($row = $stmt->fetch()) {
            $dbData->addRow($row);
        }
        return $dbData;
    }
}
