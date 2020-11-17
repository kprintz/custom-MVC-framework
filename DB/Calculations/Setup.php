<?php

namespace DB\Calculations;

use DB\Core\DbConnect;
use Model\Resource\CalculationsResource;

class Setup extends DbConnect implements \DB\Core\DbSetupInterface
{
    public function initialize()
    {
        $calcModel = new CalculationsResource();

        $sql = 'CREATE TABLE ' . $calcModel::TABLE_NAME . ' (ID INT AUTO_INCREMENT PRIMARY KEY, ' .
            $calcModel::COL_IP . ' CHAR(28), ' .
            $calcModel::COL_DATE . ' DATETIME, ' .
            $calcModel::COL_CALCULATION . ' CHAR(10))';

        $stmt = $this->connect();
        return $stmt->exec($sql);
    }
}
