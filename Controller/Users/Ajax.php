<?php

namespace Controller\Users;

use Controller\Core\ControllerAjaxAbstract;
use Model\Users\Users;
use Model\Users\UsersResource;

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
        $usersResource = new UsersResource();

        //todo need to update 'rows' to get all data instead of a single row once getalldata function is working
        return json_encode([
            'succes' => 'ajax request processed',
            'tableHeaders' => $usersResource->getColumnNames(),
            'rows' => $usersResource->getrow(50)
        ]);
    }

    public function add()
    {
        $usersModel = new Users();
        $usersModel->setFirst('Katherine');
        $usersModel->setLast('Printz');
        $usersModel->setDob('1990-05-08');
        $usersModel->setDeleted(0);
        $usersModel->save();

        return json_encode([
            //todo decide what to return
        ]);
    }

    public function update()
    {
        $usersModel = new Users();
        $usersModel->setId(3);
        $usersModel->setFirst('Katherine');
        $usersModel->setLast('Printz');
        $usersModel->setDob('1990-05-08');
        $usersModel->setDeleted(0);
        $usersModel->save();

        $usersModel->load(3);

        return json_encode([
            //todo decide what to return
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
        //todo update this to use user model - user collections?

    }

    public function getAllData()
    {
        //todo update this to use user model - user collections?

    }
}