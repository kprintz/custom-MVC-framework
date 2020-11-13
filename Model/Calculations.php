<?php

namespace Model;

use DB\Core\DbConnect;

class Calculations extends DbConnect
{
    const TABLE_NAME = 'Calculations';
    const COL_IP = 'ip';
    const COL_DATE = 'date';
    const COL_CALCULATION = 'calculation';

    /**
     * @return bool
     */
    public function addCalculation($ip, $date, $calculation)
    {
        $sql = 'INSERT INTO ' . $this::TABLE_NAME . ' (' . $this::COL_IP . ', ' . $this::COL_DATE . ', ' . $this::COL_CALCULATION . ') VALUES (?,?,?)';
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$ip, $date, $calculation]);
    }

    public function updateCalculation($column = 'calculation', $currentValue = null, $newValue = null)
    {
        $sql = 'UPDATE ' . $this::TABLE_NAME . ' SET ' . $column . ' = \'' . $newValue . '\'  WHERE ' . $column . ' = \'' . $currentValue . '\'';
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute();
    }

    public function deleteCalculation($column, $value = null)
    {
        $sql = 'DELETE FROM ' . $this::TABLE_NAME . ' WHERE ' . $column . ' = \'' . $value . '\'';
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute();
    }

    public function getRows($column, $value)
    {
        $output = [];

        $sql = 'SELECT * FROM ' . $this::TABLE_NAME . ' WHERE ' . $column . ' = \'' . $value . '\'';

        $result = $this->connect()->query($sql);

        while ($row = $result->fetch()) {
            $output[] = $row;
        }
        return $output;
    }

    /**
     * @return array
     */
    public function getAllCalculations()
    {
        $output = [];
        $sql = 'SELECT * FROM ' . $this::TABLE_NAME;

        $result = $this->connect()->query($sql);

        while ($row = $result->fetch()) {
            $output[] = $row;
        }

        return $output;
    }
}
