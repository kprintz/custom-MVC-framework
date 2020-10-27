<?php

class Test extends DBConnect
{
    public function setDate()
    {
        $sql = "INSERT INTO calculations(ip, calcDate, calculation) VALUES(1270000000, 2020-10-26, 123456)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute($sql);
    }
}
