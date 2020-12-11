<?php

namespace DB\Users;

use DB\Core\DbConnect;
use Model\Users\UsersResource;

class Setup extends DbConnect implements \DB\Core\DbSetupInterface
{
    public function initialize()
    {
        $usersModel = new UsersResource();
        $sql = 'CREATE TABLE ' . $usersModel->TABLE_NAME . ' ('.
            $usersModel->COL_ID . ' INT AUTO_INCREMENT PRIMARY KEY, ' .
            $usersModel->COL_FN . ' VARCHAR(50), ' .
            $usersModel->COL_LN . ' VARCHAR(50), ' .
            $usersModel->COL_DOB . ' DATE), ' .
            $usersModel->COL_DELETED . ' TINYINT(1))';

        $stmt = $this->connect();
        return $stmt->exec($sql);
    }
}