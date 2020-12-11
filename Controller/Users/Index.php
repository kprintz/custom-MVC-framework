<?php


namespace Controller\Users;

use Controller\Core\ControllerAbstract;
use Model\Users\Users;

class Index extends ControllerAbstract
{
    public function add()
    {
        $usersModel = new Users();
        $usersModel->setFirst('Katherine');
        $usersModel->setLast('Printz');
        $usersModel->setDob('1990-05-08');
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
        $usersModel->setDeleted(date('Y-m-d'));
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
        $usersModel->setDeleted(date('Y-m-d'));
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
