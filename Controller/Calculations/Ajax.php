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
    private $responseMessages = [
        'add' => 'Your data was added',
        'update' => 'Data was updated',
        'delete' => 'The specified data has been removed',
        null => ''
    ];

    public function getTableDisplay($action = null)
    {
        $calcModel= new Calculations();
        $template = new Template();
        $responseMessage = $this->responseMessages[$action];

        return json_encode([
            'response' => true,
            'responseMessage' => $responseMessage,
            'template' => $template->render(),
            'tableData' => $calcModel->getCollection()->getAllData()->getItems()
        ]);
    }

    public function add()
    {
        $request = $this->getRequest();
        $template = new Template();

        $calcModel = new Calculations();
        $calcModel->setIp($request->getIP());
        $calcModel->setDate($request->getDate());
        $calcModel->setCalculation($request->getPostData('inputValue'));
        $calcModel->setDeleted(0);
        $calcModel->save();

        return $this->getTableDisplay('add');
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

        return $this->getTableDisplay('update');
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

        return $this->getTableDisplay('delete');
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
            'responseMessage' => 'Displaying all data matching query',
            'tableData' => $collection
        ]);
    }

    public function getAllData()
    {
        $calcModel = new Calculations();

        $collection = $calcModel->getCollection()->getAllData()->getItems();

        return json_encode([
            'response' => true,
            'tableData' => $collection
        ]);
    }
}
