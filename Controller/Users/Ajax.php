<?php

namespace Controller\Users;

use Controller\Core\ControllerAjaxAbstract;
use Model\Users\Users;
use View\Template;

/**
 * Child class for Users-related Ajax controller actions
 *
 * Class Ajax
 * @package Controller\Users
 */
class Ajax extends ControllerAjaxAbstract
{
    public function getTableDisplay()
    {
        $usersModel= new Users();
        $template = new Template();
        $template->setData(
            'columnNames',
            $usersModel->getResource()->getPublicColumnNames()
        );

        return json_encode([
            'succes' => 'ajax request processed',
            'tableHeaders' => $usersModel->getResource()->getColumnNames(),
            'formActions' => $template->render(['View/templates/tables_form.phtml']),
            'tableDisplay' => $template->render(['View/templates/table_display.phtml']),
            'tableData' => $usersModel->getCollection()->getAllData()->getItems()
        ]);
    }

    public function add()
    {
        $request = $this->getRequest();

        $usersModel = new Users();
        $usersModel->setFirstName($request->getPostData('firstName'));
        $usersModel->setLastName($request->getPostData('lastName'));
        $usersModel->setDob($request->getPostData('dob'));
        $usersModel->setDeleted(0);
        $usersModel->save();

        return $this->getTableDisplay();
    }

    public function update()
    {
        $request = $this->getRequest();
        $filterBy = $request->getPostData('columnName');
        $currentValue = $request->getPostData('filterValue');
        $updateTo = $request->getPostData('newValue');

        $usersModel = new Users();

        $collection = $usersModel->getCollection()->addFilter(
            [$filterBy => $currentValue]
        )->getItems();
        foreach ($collection as $usersItem) {
            $usersItem->setData($filterBy, $updateTo);
            $usersItem->save();
        }

        return $this->getTableDisplay();
    }

    public function delete()
    {
        $request = $this->getRequest();
        $filterBy = $request->getPostData('columnName');
        $currentValue = $request->getPostData('filterValue');

        $usersModel = new Users();
        $collection = $usersModel->getCollection()->addFilter(
            [$filterBy => $currentValue]
        )->getItems();
        foreach ($collection as $usersItem) {
            $usersItem->setDeleted(1);
            $usersItem->save();
        }

        return $this->getTableDisplay();
    }

    public function filter()
    {
        $request = $this->getRequest();
        $filterBy = $request->getPostData('columnName');
        $currentValue = $request->getPostData('filterValue');

        $usersModel = new Users();

        $collection = $usersModel->getCollection()->addFilter(
            [$filterBy => $currentValue]
        )->getItems();
        foreach ($collection as $usersItem) {
            $usersItem->save();
        }

        return json_encode([
            'succes' => 'ajax request processed',
            'tableData' => $collection
        ]);
    }

    public function getAllData()
    {
        $usersModel = new Users();

        $collection = $usersModel->getCollection()->getAllData()->getItems();

        return json_encode([
            'succes' => 'ajax request processed',
            'tableData' => $collection
        ]);
    }
}