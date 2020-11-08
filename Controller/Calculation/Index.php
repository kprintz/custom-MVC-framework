<?php

namespace Controller\Calculation;

use Model\Calculations;

class Index extends Calculations
{
    public function add()
    {
        //todo get the request data (post data from JS / ajax)
        $ip = $_SERVER['REMOTE_ADDR'];
        $today = date('Y-m-d');
        //todo put server post info into object
        $calculation = (int)$_POST['calculation'];

        $status = $this->addCalculation($ip, $today, $calculation);

        return json_encode([
            'estes' => 'seitjhseitj'
        ]);
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