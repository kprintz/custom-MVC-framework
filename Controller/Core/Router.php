<?php

namespace Controller\Core;

class Router
{
    /** @var string $request */
    private $request;

    public function __construct()
    {
        $this->request = new \Model\Request();
    }

    public function getFullRoute()
    {
        $defaults = [
            'Homepage',
            'Index',
            'execute'
        ];
        $requestArray = explode('/', $this->request->getUri());
        $requestArray = array_filter($requestArray);
        $requestArray = array_values($requestArray);

        for ($i = 0; $i < 3; $i++) {
            if (!array_key_exists($i, $requestArray)) {
                $requestArray[$i] = $defaults[$i];
            }
        }

        return $requestArray;
    }

    /**
     * @return string Full HTML response
     */
    public function getResponse()
    {
        //todo maybe request these by name
        $controllerGroup = $this->getFullRoute()[0];
        $controller = $this->getFullRoute()[1];
        $method = $this->getFullRoute()[2];
        $indexRouter = '\\Controller\\' . $controllerGroup . '\\' . $controller;

        if (class_exists($indexRouter)) {
            $indexRouter = new $indexRouter;
            return $indexRouter->$method();
        } else {
            $indexRouter = '\\Controller\\' . 'Error\\' . 'Index';
            $indexRouter = new $indexRouter;
            return $indexRouter->$method();
        }
    }
}
