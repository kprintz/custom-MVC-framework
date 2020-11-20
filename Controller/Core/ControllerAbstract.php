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

    public function getTemplateContents(array $contents)
    {
        extract([$this]);
        ob_start();
        foreach ($contents as $content) {
            include $content;
        }
        return ob_get_clean();
    }
}
