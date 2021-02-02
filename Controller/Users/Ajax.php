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
            'template' => $template->render(),
            'tableHeaders' => $usersModel->getResource()->getColumnNames(),
            'tableData' => $usersModel->getCollection()->getAllData()->getItems()
        ]);
    }

    public function verify()
    {
        $request = $this->getRequest();
        $usernameEntered = $request->getPostData('username');
        $passwordEntered = $request->getPostData('password');

        $usersModel = new Users();

        $usernameExists = $usersModel->getCollection()->addFilter([
                'username' => $usernameEntered]
        )->getItems();
        if ($usernameExists) {
            if ($usernameExists[0]->password == $passwordEntered) {
                return json_encode([
                    'response' => true
                ]);
            } else {
                return json_encode([
                    'response' => false,
                    'responseMessage' => 'Invalid Login'
                ]);
            }
        } else {
            return json_encode([
                'response' => false,
                'responseMessage' => 'Invalid Login'
            ]);
        }
    }

    public function add()
    {
        $request = $this->getRequest();

        $usersModel = new Users();
        $usersModel->setFirstName($request->getPostData('first'));
        $usersModel->setLastName($request->getPostData('last'));
        $usersModel->setDob($request->getPostData('dob'));
        $usersModel->setUsername($request->getPostData('username'));
        $usersModel->setPassword($request->getPostData('password'));
        $usersModel->setDeleted(0);

        $collection = $usersModel->getCollection()->addFilter(
            ['username' => $usersModel->getUsername()]
        )->getItems();
        if ($collection) {
            return json_encode([
                'response' => false,
                'responseMessage' => 'This username is taken. Please try a new username.'
            ]);
        }

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