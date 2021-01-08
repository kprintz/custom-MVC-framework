<?php

namespace Model\Users;

use Model\AbstractModel;

class Users extends AbstractModel
{
    protected string $table = 'Users';

    public function setFirstName($firstName)
    {
        $this->setData('firstName', $firstName);
        return $this;
    }

    public function getFirstName()
    {
        return $this->getData('firstName');
    }

    public function setLastName($lastName)
    {
        $this->setData('lastName', $lastName);
        return $this;
    }

    public function getLastName()
    {
        return $this->getData('lastName');
    }

    public function setDob($dob)
    {
        $this->setData('dob', $dob);
        return $this;
    }

    public function getDob()
    {
        return $this->getData('dob');
    }
}
