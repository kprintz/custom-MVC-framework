<?php

namespace Model\Users;

use Model\AbstractModel;

class Users extends AbstractModel
{
    public string $table = 'Users';

    public function setFirstName($firstName)
    {
        $this->setData('first', $firstName);
        return $this;
    }

    public function getFirstName()
    {
        return $this->getData('first');
    }

    public function setLastName($lastName)
    {
        $this->setData('last', $lastName);
        return $this;
    }

    public function getLastName()
    {
        return $this->getData('last');
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

    public function setUsername($username)
    {
        $this->setData('username', $username);
        return $this;
    }

    public function getUsername()
    {
        return $this->getData('username');
    }

    public function setPassword($password)
    {
        $this->setData('password', $password);
        return $this;
    }

    public function getPassword()
    {
        return $this->getData('password');
    }
}
