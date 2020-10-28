<?php

class DBSetup extends DBConnect
{
    public function initializeDatabase()
    {
        $sql = 'CREATE TABLE calculations (ID INT AUTO_INCREMENT PRIMARY KEY,
                                    IP INT UNSIGNED,
                                    Date DATE,
                                    Calculation CHAR(10))';

        $stmt = $this->connect();
        return $stmt->exec($sql);
        //todo create tables here (run this once only)

    }
}
