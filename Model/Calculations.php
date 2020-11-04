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
        $sql = 'INSERT INTO ' . $this::TABLE_NAME . ' (' . $this::COL_IP . ', ' . $this::COL_DATE . ', ' . $this::COL_CALCULATION . ') VALUES (INET_ATON(?),?,?)';
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$ip, $date, $calculation]);
    }

    public function getRows($column, $value)
    {
        if ($column == $this::COL_IP) {
            $sql = 'SELECT * FROM ' . $this::TABLE_NAME . ' WHERE ' . $this::COL_IP . ' = ' . '(INET_ATON(\'' . $value . '\'))';
        } else {
            $sql = 'SELECT * FROM ' . $this::TABLE_NAME . ' WHERE ' . $column . ' = \'' . $value . '\'';
        }

        $result = $this->connect()->query($sql);

        while ($row = $result->fetch()) {
            echo $row[$this::COL_IP] . '||' . $row[$this::COL_DATE] . '||' . $row[$this::COL_CALCULATION] . '<br>';
        }
    }

    /**
     *
     */
    public function getAllCalculations()
    {
        $sql = 'SELECT * FROM ' . $this::TABLE_NAME;
        $result = $this->connect()->query($sql);
        while ($row = $result->fetch()) {
            echo $row[$this::COL_IP] . '||' . $row[$this::COL_DATE] . '||' . $row[$this::COL_CALCULATION] . '<br>';
        }
    }

    public function updateCalculation($column = 'calculation', $currentValue = null, $newValue = null)
    {

        if ($column == $this::COL_IP) {
            $sql = 'UPDATE ' . $this::TABLE_NAME . ' SET ' . $this::COL_IP . ' = (INET_ATON(\'' . $newValue . '\'))' . '  WHERE ' . $this::COL_IP . ' = (INET_ATON(\'' . $currentValue . '\'))';
        } else {
            $sql = 'UPDATE ' . $this::TABLE_NAME . ' SET ' . $column . ' = \'' . $newValue . '\'  WHERE ' . $column . ' = \'' . $currentValue . '\'';
        }

        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute();
    }

    public function deleteCalculation($column, $value = null)
    {

        if ($column == $this::COL_IP) {
            $sql = 'DELETE FROM ' . $this::TABLE_NAME . ' WHERE ' . $this::COL_IP . ' = ' . '(INET_ATON(\'' . $value . '\'))';
        } else {
            $sql = 'DELETE FROM ' . $this::TABLE_NAME . ' WHERE ' . $column . ' = \'' . $value . '\'';
        }

        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute();
    }
}
