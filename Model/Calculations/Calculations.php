<?php

namespace Model\Calculations;

use Model\AbstractModel;

class Calculations extends AbstractModel
{
    protected string $table = 'Calculations';

    //todo we can look at this together later (should auto serialize when we are asking this instantiated Class to turn into an array)
    public function __serialize(): array
    {
        return [];
    }

    public function setIp($ip)
    {
        $this->setData('ip', $ip);
        return $this;
    }

    public function getIp()
    {
        return $this->getData('ip');
    }

    public function setDate($date)
    {
        $this->setData('date', $date);
        return $this;
    }

    public function getDate()
    {
        return $this->getData('date');
    }

    public function setCalculation($calculation)
    {
        $this->setData('calculation', $calculation);
        return $this;
    }

    public function getCalculation()
    {
        return $this->getData('calculation');
    }
}
