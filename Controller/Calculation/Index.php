<?php

namespace Controller\Calculation;

use Controller\Core\ControllerAbstract;
use Model\Calculations\Calculations;

class Index extends ControllerAbstract
{
    public function add()
    {
        $calcModel = new Calculations();
        $calcModel->setId(50);
        $calcModel->setIp('127.0.0.2');
        $calcModel->setDate('1990-12-08');
        $calcModel->setCalculation(123456);
        $calcModel->save();

        return json_encode([
            //todo decide what to return
        ]);
    }

    public function update()
    {
        $calcModel = new Calculations();
        $calcModel->setDate('1989-12-02');
        $calcModel->setIp('127.0.0.2');
        $calcModel->setCalculation(999);
        $calcModel->setDeleted(date('Y-m-d'));
        $calcModel->setId(3);
        $calcModel->save();

        $calcModel->load(3);

        return json_encode([
            //todo decide what to return
        ]);
    }

    public function delete()
    {
        $calcModel = new Calculations();
        $calcModel->setDeleted(date('Y-m-d'));
        $calcModel->setId(29);
        $calcModel->save();

        return json_encode([
            //todo decide what to return
        ]);
    }

    public function filter()
    {
        //todo update this to use calcmodel - calccollections?

    }

    public function getAllData()
    {
        //todo update this to use calcmodel - calccollections?

    }
}

