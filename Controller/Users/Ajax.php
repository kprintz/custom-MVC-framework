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

        return json_encode([
            'response' => true,
            'responseMessage' => 'ajax request processed',
            'template' => $template->render(),
            'tableData' => $usersModel->getCollection()->getAllData()->getItems()
        ]);
    }

    public function verify()
    {
        $request = $this->getRequest();
        $usernameEntered = $request->getPostData('username');
        $passwordEntered = md5($request->getPostData('password'));

        $usersModel = new Users();

        $usernameExists = $usersModel->getCollection()->addFilter([
                'username' => $usernameEntered]
        )->getItems();
        if ($usernameExists) {
            if ($usernameExists[0]->password == $passwordEntered) {
                $_SESSION['username'] = $usernameEntered;
                return json_encode([
                    'response' => true,
                    'responseMessage' => 'Success!'
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
        $usersModel->setPassword(md5($request->getPostData('password')));
        $usersModel->setDeleted(0);

        $collection = $usersModel->getCollection()->addFilter(
            ['username' => $usersModel->getUsername()]
        )->getItems();
        if ($collection) {
            return json_encode([
                'response' => false,
                'responseMessage' => 'Username already exists. Please login or try a different username.'
            ]);
        } else {
            $usersModel->save();

            return $this->getTableDisplay();
        }
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
            'response' => true,
            'responseMessage' => 'ajax request processed',
            'tableData' => $collection
        ]);
    }

    public function getAllData()
    {
        $usersModel = new Users();

        $collection = $usersModel->getCollection()->getAllData()->getItems();

        return json_encode([
            'response' => true,
            'responseMessage' => 'ajax request processed',
            'tableData' => $collection
        ]);
    }
}