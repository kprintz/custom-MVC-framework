<?php

namespace View;

use Controller\Core\Router;
use Model\Request;

class Template
{
    public $viewFile;
    public $data;
    public $request;
    public $router;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router();
        $this->viewFile = file_get_contents("View/view.json");
        //todo look into base getter/setter (returns null safely)
        $this->data = json_decode($this->viewFile, true);
        $routeString = implode('/', $this->router->getFullRoute());
        if (!array_key_exists($routeString, $this->data)) {
            die('404');
        } else {
            $this->childList = $this->data[$routeString];
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

    /**
     * @return array
     */
    public function getLayout()
    {
        return [];
    }

    public function getChildHtml()
    {
        return $this->getLayout();
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
