<?php

namespace Controller\Calculation;

use Model\Calculations;

class Index extends Calculations
{
    public function add()
    {
        $this->addCalculation('127.00.01.2', '2020-11-04', '43110');
        return 'this worked the add thinsg did';
    }

    public function update()
    {
        $this->updateCalculation('date', '2020-11-04', '2020-11-05');
        return 'this worked the update thinsg did';
    }

    public function remove()
    {
        $this->deleteCalculation('calculation', '43110');
        return 'this worked the remove thinsg did';
    }
}