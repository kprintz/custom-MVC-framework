<?php

namespace Controller\Users;

use Controller\Core\ControllerAjaxAbstract;
use Model\Users\Users;
use Model\Users\UsersResource;
use Model\Users\UsersCollection;
use Model\Users\UsersCollectionResource;

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

        return json_encode([
            'succes' => 'ajax request processed',
            'tableHeaders' => $usersModel->getResource()->getColumnNames(),
            'rows' => $usersModel->getCollection()->getAllData()->getItems()
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

        $usersModel = new Users();

        $collection = $usersModel->getCollection()->addFilter(
            [$filterBy => $currentValue]
        )->getItems();
        foreach ($collection as $usersItem) {
            $usersItem->setData($filterBy, $updateTo);
            $usersItem->save();
        }

        return json_encode([
            $collection
        ]);
    }

    public function delete()
    {
        $usersModel = new Users();
        $usersModel->setId(29);
        $usersModel->setDeleted(1);
        $usersModel->save();

        return json_encode([
            //todo decide what to return
        ]);
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

        return json_encode([
            $collection
        ]);
    }

    public function getAllData()
    {
        //todo update this to use user model - user collections?

    }
}