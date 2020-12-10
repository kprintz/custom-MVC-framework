<?php

namespace DB\Calculations;

use DB\Core\DbConnect;
use Model\Resource\CalculationsResource;

class Setup extends DbConnect implements \DB\Core\DbSetupInterface
{
    public function initialize()
    {
        $calcModel = new CalculationsResource();
        //todo consider changing to DATETIME - will impact how the update function works if changing the date column data
        $sql = 'CREATE TABLE ' . $calcModel->TABLE_NAME . ' ('.
            $calcModel->COL_ID . ' INT AUTO_INCREMENT PRIMARY KEY, ' .
            $calcModel->COL_IP . ' CHAR(28), ' .
            $calcModel->COL_DATE . ' DATE, ' .
            $calcModel->COL_CALCULATION . ' CHAR(10))';

        $stmt = $this->connect();
        return $stmt->exec($sql);
    }
}
