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

        //todo return json data to functions which will be used through ajax
        return json_encode([
            'estes' => 'seitjhseitj'
        ]);
    }

    public function getData()
    {
        $column = $_POST['columnName'];
        $value = $_POST['inputData'];

        $this->getRows($column, $value);

        return 'this worked the get data thinsg did';
    }

    public function getAllData()
    {
        $this->getAllCalculations();

        return 'this worked the get data thinsg did';
    }

    public function update()
    {
        $column = $_POST['columnName'];
        $currentVal = $_POST['currentValue'];
        $newVal = $_POST['newValue'];

        $this->updateCalculation($column, $currentVal, $newVal);

        return 'this worked the update thinsg did';
    }

    public function remove()
    {
        $column = $_POST['columnName'];
        $value = $_POST['inputData'];

        $this->deleteCalculation($column, $value);

        return 'this worked the remove thinsg did';
    }
}