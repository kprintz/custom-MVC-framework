<?php

class Test extends DBConnect
{
    public function addCalculation()
    {
        $sql = "INSERT INTO calculations (ip, calcDate, calculation) VALUES (INET_ATON(),,)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }

    public function getCalculation($ip = null)
    {

    }

    public function getAllCalculations()
    {

    }

    public function updateCalculation()
    {

    }

    public function deleteCalculation()
    {

    }
}
