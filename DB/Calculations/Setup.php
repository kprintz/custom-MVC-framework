<?php

namespace DB\Calculations;

use DB\Core\DbConnect;
use Model\Calculations;

class Setup extends DbConnect implements \DB\Core\DbSetupInterface
{
    public function initialize()
    {
        $calcModel = new Calculations();

        $sql = 'CREATE TABLE ' . $calcModel::TABLE_NAME . ' (ID INT AUTO_INCREMENT PRIMARY KEY, ' .
            $calcModel::COL_IP . ' CHAR(28), ' .
            $calcModel::COL_DATE . ' DATE, ' .
            $calcModel::COL_CALCULATION . ' CHAR(10))';

        $stmt = $this->connect();
        return $stmt->exec($sql);
    }
}
