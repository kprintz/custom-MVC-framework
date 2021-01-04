<?php

namespace DB\Calculations;

use DB\Core\DbConnect;
use Model\Calculations\CalculationsResource;

class Setup extends DbConnect implements \DB\Core\DbSetupInterface
{
    public function initialize()
    {
        //todo change variable to calcResource
        $calcModel = new CalculationsResource();
        //todo consider changing to DATETIME - will impact how the update function works if changing the date column data
        $sql = 'CREATE TABLE IF NOT EXISTS ' . $calcModel->TABLE_NAME . ' ('.
            $calcModel->COL_ID . ' INT AUTO_INCREMENT PRIMARY KEY, ' .
            $calcModel->COL_IP . ' CHAR(28), ' .
            $calcModel->COL_DATE . ' DATE, ' .
            $calcModel->COL_CALCULATION . ' VARCHAR(255), ' .
            $calcModel->COL_DELETED . ' TINYINT(1))';

        $stmt = $this->connect();
        return $stmt->exec($sql);
    }
}
