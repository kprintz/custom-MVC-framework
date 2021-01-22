<?php

namespace DB\Users;

use DB\Core\DbConnect;
use Model\Users\Users;

class Setup extends DbConnect implements \DB\Core\DbSetupInterface
{
    public function initialize()
    {
        $usersModel = new Users();
        $usersResource = $usersModel->getResource();
        $sql = 'CREATE TABLE IF NOT EXISTS ' . $usersModel->table . ' ('.
            $usersResource->COL_ID . ' INT AUTO_INCREMENT PRIMARY KEY, ' .
            $usersResource->COL_FN . ' VARCHAR(50), ' .
            $usersResource->COL_LN . ' VARCHAR(50), ' .
            $usersResource->COL_DOB . ' DATE, ' .
            $usersResource->COL_USN . ' VARCHAR(25), ' .
            $usersResource->COL_PWD . ' VARCHAR(40), ' .
            $usersResource->COL_DELETED . ' TINYINT(1))';

        $stmt = $this->connect();
        return $stmt->exec($sql);
    }
}