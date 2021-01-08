<?php

namespace Controller\Calculations;

use Controller\Core\ControllerAjaxAbstract;
use Model\Calculations\Calculations;
use Model\Calculations\CalculationsCollections;
use Model\Calculations\CalculationsCollectionResource;
use Model\Calculations\CalculationsResource;

/**
 * Child class for Calculations-related Ajax controller actions
 *
 * Class Ajax
 * @package Controller\Calculations
 */
class Ajax extends ControllerAjaxAbstract
{
    public function getTableDisplay()
    {
        $calcResource = new CalculationsResource();

        //todo need to update 'rows' to get all data instead of a single row once getalldata function is working
        return json_encode([
            'succes' => 'ajax request processed',
            'tableHeaders' => $calcResource->getColumnNames(),
            'rows' => $calcResource->getrow(50)
        ]);
    }

    public function add()
    {
        $request = $this->getRequest();

        $calcModel = new Calculations();
        $calcModel->setIp($request->getIP());
        $calcModel->setDate($request->getDate());
        $calcModel->setCalculation($request->getPostData('calculation'));
        $calcModel->setDeleted(0);
        $calcModel->save();

        return json_encode([
            //todo decide what to return
        ]);
    }

    public function update()
    {
        $request = $this->getRequest();
        $filterBy = $request->getPostData('columnName');
        $currentValue = $request->getPostData('filterValue');
        $updateTo = $request->getPostData('newValue');

        $calcModel = new Calculations();

        $calcs = $calcModel->getCollection()->addFilter(
            [$filterBy => $currentValue]
        )->getItems();
        foreach ($calcs as $calcItem) {
            $calcItem->setData($filterBy, $updateTo);
            $calcItem->save();
        }

        return json_encode([
            $calcs
        ]);
    }

    public function delete()
    {
        $calcModel = new Calculations();
        $calcModel->setDeleted(1);
        $calcModel->setId(29);
        $calcModel->save();

        return json_encode([
            //todo decide what to return
        ]);
    }

    public function filter()
    {
        $request = $this->getRequest();

        $calcCollection = new CalculationsCollections();
        $calcCollectionResource = new CalculationsCollectionResource();
        $calcCollectionResource->filter([
            $request->getPostData('columnName'),
            $request->getPostData('filterValue')]);

        return json_encode([
            //todo decide what to return
        ]);
    }

    public function getAllData()
    {
        //todo update this to use calcmodel - calccollections?

    }
}
