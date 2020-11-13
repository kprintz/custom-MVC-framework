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

    public function update()
    {
        $column = $_POST['columnName'];
        $currentVal = $_POST['currentValue'];
        $newVal = $_POST['newValue'];

        $status = $this->updateCalculation($column, $currentVal, $newVal);

        if ($status) {
            $successMessage = 'All rows where \'' . $column . '\' matches ' . $currentVal . ' have been changed to ' . $newVal;
        } else if ($status == null) {
            $successMessage = 'There are no rows where ' . $column . ' equals ' . $currentVal;
        } else {
            $successMessage = "Update request not completed";
        }

        //todo upgrade all to this
        return json_encode([
            'updateStatus' => $status,
            'successMessage' => $successMessage,
            'allResults' => $this->getAllCalculations()
        ]);
    }

    public function remove()
    {
        $column = $_POST['columnName'];
        $value = $_POST['inputData'];

        $this->deleteCalculation($column, $value);

        $status = $this->deleteCalculation($column, $value);

        if ($status) {
            $successMessage = 'All rows where \'' . $column . '\' matches ' . $value . ' have been deleted';
        } else if ($status == null) {
            $successMessage = "No matches found";
        } else {
            $successMessage = "Delete request not completed";
        }

        //todo upgrade all to this
        return json_encode([
            'updateStatus' => $status,
            'successMessage' => $successMessage,
            'allResults' => $this->getAllCalculations()
        ]);
    }

    public function getData()
    {
        $column = $_POST['columnName'];
        $value = $_POST['inputData'];

        $status = $this->getRows($column, $value);

        if ($status) {
            $successMessage = 'Displaying all rows where ' . $column . ' is equal to ' . $value;
        } else if ($status == null) {
            $successMessage = "No matches found";
        } else {
            $successMessage = "There was an error";
        }

        return json_encode([
            'updateStatus' => $status,
            'successMessage' => $successMessage,
            'allResults' => $this->getRows($column, $value)
        ]);
    }

    public function getAllData()
    {
        $status = $this->getAllCalculations();

        if ($status) {
            $successMessage = 'Displaying all data';
        } else {
            $successMessage = "There was an error";
        }

        //todo upgrade all to this
        return json_encode([
            'updateStatus' => $status,
            'successMessage' => $successMessage,
            'allResults' => $this->getAllCalculations()
        ]);
    }
}