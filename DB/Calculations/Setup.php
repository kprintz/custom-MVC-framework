<?php

namespace DB\Calculations;

use DB\Core\DbConnect;
use Model\Calculations\Calculations;

class Setup extends DbConnect implements \DB\Core\DbSetupInterface
{
    public function initialize()
    {
        $calcModel = new Calculations();
        $calcResource = $calcModel->getResource();
        //todo consider changing to DATETIME - will impact how the update function works if changing the date column data
        $sql = 'CREATE TABLE IF NOT EXISTS ' . $calcResource->TABLE_NAME . ' ('.
            $calcResource->COL_ID . ' INT AUTO_INCREMENT PRIMARY KEY, ' .
            $calcResource->COL_IP . ' CHAR(28), ' .
            $calcResource->COL_DATE . ' DATE, ' .
            $calcResource->COL_CALCULATION . ' VARCHAR(255), ' .
            $calcResource->COL_DELETED . ' TINYINT(1))';

        $stmt = $this->connect();
        return $stmt->exec($sql);
    }
}
