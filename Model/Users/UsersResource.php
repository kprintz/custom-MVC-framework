<?php

namespace Model\Users;

use Model\AbstractResource;

class UsersResource extends AbstractResource
{
    public string $COL_FN = 'first';
    public string $COL_LN = 'last';
    public string $COL_DOB = 'dob';
    public string $COL_USN = 'username';
    public string $COL_PWD = 'password';

    public function getColumnNames()
    {
        return [
            $this->COL_ID,
            $this->COL_FN,
            $this->COL_LN,
            $this->COL_DOB,
            $this->COL_USN,
            $this->COL_PWD,
            $this->COL_DELETED
        ];
    }
}
