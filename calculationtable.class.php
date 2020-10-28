<?php

class CalculationTable extends DBConnect
{
    /**
     * @return bool
     */
    public function addCalculation($ip, $date, $calculation)
    {
        $sql = "INSERT INTO calculations (IP, Date, Calculation) VALUES (INET_ATON(?),?,?)";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$ip, $date, $calculation]);
    }

    public function getRows($column, $value)
    {
        if ($column == 'IP') {
            $sql = 'SELECT * FROM calculations WHERE IP = ' . '(INET_ATON(\'' . $value . '\'))';
        } else {
            $sql = 'SELECT * FROM calculations WHERE ' . $column . ' = \'' . $value . '\'';
        }

        $result = $this->connect()->query($sql);

        while ($row = $result->fetch()) {
            echo $row['IP'] . '||' . $row['Date'] . '||' . $row['Calculation'] . '<br>';
        }
    }

    /**
     *
     */
    public function getAllCalculations()
    {
        $sql = "SELECT * FROM calculations";
        $result = $this->connect()->query($sql);
        while ($row = $result->fetch()) {
            echo $row['IP'] . '||' . $row['Date'] . '||' . $row['Calculation'] . '<br>';
        }
    }

    public function updateCalculation($column = 'calculation', $currentValue = null, $newValue = null)
    {

        if ($column == 'IP') {
            $sql = 'UPDATE calculations SET IP = ' . '(INET_ATON(\'' . $newValue . '\'))' . '  WHERE IP = ' . '(INET_ATON(\'' . $currentValue . '\'))';
        } else {
            $sql = 'UPDATE calculations SET ' . $column . ' = ' . $newValue . '  WHERE ' . $column . ' = ' . $currentValue;
        }

        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute();
    }

    public function deleteCalculation($column, $value = null)
    {

        if ($column == 'IP') {
            $sql = 'DELETE FROM calculations WHERE IP = ' . '(INET_ATON(\'' . $value . '\'))';
        } else {
            $sql = 'DELETE FROM calculations WHERE ' . $column . ' = \'' . $value . '\'';
        }

        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute();
    }
}
