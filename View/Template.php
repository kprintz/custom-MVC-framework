<?php

namespace View;

use Controller\Core\Router;
use Model\Request;

class Template
{
    public $viewFile;
    public $data;
    public $router;

    public function __construct($routeString = null)
    {
        $this->router = new Router();
        $this->viewFile = file_get_contents("View/view.json");
        //todo look into base getter/setter (returns null safely)
        $this->data = json_decode($this->viewFile, true);
        if (!$routeString) {
            $this->routeString = implode('/', $this->router->getFullRoute());
        } else {
            $this->routeString = $routeString;
        }
        if (!array_key_exists($this->routeString, $this->data)) {
            die('404');
        } else {
            $this->childList = $this->data[$this->routeString];
        }
    }

    private function renderChildren()
    {
        foreach ($this->childList as $blockName => $children) {
            $blockClass = '\\View\\Block\\'.$blockName;
            $block = new $blockClass($children);
            $block->render();
        }
    }

    public function setData($key, $data)
    {
        $this->{$key} = $data;
        return $this;
    }

    public function render()
    {
        extract([$this]);
        $this->renderChildren();
        return ob_get_clean();
    }
}
