<?php

namespace DB\Calculations;

use DB\Core\DBConnect;
use Model\Calculations;

class Setup extends DBConnect implements \DB\Core\DbSetupInterface
{
    public function initialize()
    {
        $calcModel = new Calculations();
        $calcModel::TABLE_NAME;
        $sql = 'CREATE TABLE Calculations (ID INT AUTO_INCREMENT PRIMARY KEY,
                                    ip INT UNSIGNED,
                                    date DATE,
                                    calculation CHAR(10))';

        $stmt = $this->connect();
        return $stmt->exec($sql);
        //todo create tables here (run this once only)

    }
}
