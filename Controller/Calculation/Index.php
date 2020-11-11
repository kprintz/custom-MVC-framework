<?php

namespace Controller\Calculation;

use Model\Calculations;

class Index extends Calculations
{
    public function add()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $today = date('Y-m-d');
        //todo put server post info into object
        $calculation = (int)$_POST['calculation'];

        $status = $this->addCalculation($ip, $today, $calculation);

        return json_encode([
            'estes' => 'seitjhseitj'
        ]);
    }

    public function getData()
    {
        $this->getRows('date', '2020-11-04');

        return 'this worked the get data thinsg did';
    }

    public function getAllData()
    {
        $this->getAllCalculations();

        return 'this worked the get data thinsg did';
    }

    public function update()
    {
        $this->updateCalculation('date', '2020-11-07', '2020-11-21');

        return 'this worked the update thinsg did';
    }

    public function remove()
    {
        $this->deleteCalculation('calculation', '43110');

        return 'this worked the remove thinsg did';
    }
}