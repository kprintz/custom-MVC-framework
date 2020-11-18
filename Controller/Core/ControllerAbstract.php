<?php

namespace Controller\Core;

use Model\Request;

abstract class ControllerAbstract
{
    /** @var Request $request */
    private $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function getRequest()
    {
        return $this->request;
    }
}
