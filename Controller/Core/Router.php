<?php

namespace Controller\Core;

class Router
{
    /** @var string $request */
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function getFullRoute()
    {

        $requestArray = explode('/', $this->request);
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

        if ($this->getFullRoute()[0] === 'Data') {
            $indexRouter = new \Controller\Data\Index();
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
