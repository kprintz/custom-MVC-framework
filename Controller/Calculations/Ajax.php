<?php

namespace Controller\Calculations;

use Controller\Core\ControllerAjaxAbstract;
use Model\Calculations\Calculations;
use View\Template;

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
        $template = new Template();

        return json_encode([
            'response' => true,
            'responseMessage' => 'ajax request processed',
            'template' => $template->render(),
            'tableData' => $calcModel->getCollection()->getAllData()->getItems()
        ]);
    }

    public function add()
    {
        $request = $this->getRequest();

        $calcModel = new Calculations();
        $calcModel->setIp($request->getIP());
        $calcModel->setDate($request->getDate());
        $calcModel->setCalculation($request->getPostData('inputValue'));
        $calcModel->setDeleted(0);
        $calcModel->save();

        return $this->getTableDisplay();
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

        return $this->getTableDisplay();
    }

    public function delete()
    {
        $request = $this->getRequest();
        $filterBy = $request->getPostData('columnName');
        $currentValue = $request->getPostData('filterValue');

        $calcModel = new Calculations();
        $collection = $calcModel->getCollection()->addFilter(
            [$filterBy => $currentValue]
        )->getItems();
        foreach ($collection as $calcItem) {
            $calcItem->setDeleted(1);
            $calcItem->save();
        }

        return $this->getTableDisplay();
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
        foreach ($collection as $calcItem) {
            $calcItem->save();
        }

        return json_encode([
            'response' => true,
            'responseMessage' => 'ajax request processed',
            'tableData' => $collection
        ]);
    }

    public function getAllData()
    {
        $calcModel = new Calculations();

        $collection = $calcModel->getCollection()->getAllData()->getItems();

        return json_encode([
            'response' => true,
            'responseMessage' => 'ajax request processed',
            'tableData' => $collection
        ]);
    }
}
