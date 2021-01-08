<?php

namespace Model\Users;

use Model\AbstractResource;

class UsersResource extends AbstractResource
{
    public string $COL_FN = 'first';
    public string $COL_LN = 'last';
    public string $COL_DOB = 'dob';

    public function getColumnNames()
    {
        return [
            $this->COL_ID,
            $this->COL_FN,
            $this->COL_LN,
            $this->COL_DOB,
            $this->COL_DELETED
        ];
    }
}
