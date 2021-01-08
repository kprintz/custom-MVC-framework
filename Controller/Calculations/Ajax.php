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
        $calcModel= new Calculations();

        return json_encode([
            'succes' => 'ajax request processed',
            'tableHeaders' => $calcModel->getResource()->getColumnNames(),
            'rows' => $calcModel->getCollection()->getAllData()->getItems()
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

        $collection = $calcModel->getCollection()->addFilter(
            [$filterBy => $currentValue]
        )->getItems();
        foreach ($collection as $calcItem) {
            $calcItem->setData($filterBy, $updateTo);
            $calcItem->save();
        }

        return json_encode([
            $collection
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
        $filterBy = $request->getPostData('columnName');
        $currentValue = $request->getPostData('filterValue');

        $calcModel = new Calculations();

        $collection = $calcModel->getCollection()->addFilter(
            [$filterBy => $currentValue]
        )->getItems();

        return json_encode([
            $collection
        ]);
    }

    public function getAllData()
    {
        $calcModel = new Calculations();

        $collection = $calcModel->getCollection()->getAllData()->getItems();

        return json_encode([
            $collection
        ]);

    }
}
