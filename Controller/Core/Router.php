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
        //todo make sure always returns parts - or make specific parts into sub functions
        $requestArray = explode('/', $this->request->getUri());
        $requestArray = array_filter($requestArray);
        $requestArray = array_values($requestArray);

        return $requestArray;
    }

    /**
     * @return string Full HTML response
     */
    public function getResponse()
    {
        if (empty($this->getFullRoute()[0])) {
            $indexRouter = new \Controller\Homepage\Index();
            return $indexRouter->execute();
        }

        $controllerGroup = $this->getFullRoute()[0];
        $controller = $this->getFullRoute()[1];
        $method = $this->getFullRoute()[2];
        $indexRouter = '\\Controller\\' . $controllerGroup . '\\' . $controller;
        $indexRouter = new $indexRouter;

        return $indexRouter->$method();
    }
}
