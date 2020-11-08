<?php


namespace Controller\Homepage;


class Index
{

    public function execute()
    {
        echo include_once 'View/templates/index.phtml';
    }
}
