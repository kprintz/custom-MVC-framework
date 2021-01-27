<?php

namespace View;

class Template
{
    public $viewFile;
    public $data;
    public $header;
    public $footer;
    public $controller;

    public function __construct()
    {
        //todo probably don't want to set hooter and feader this way since they may not always be the same
        $this->viewFile = file_get_contents("View/Calculations/Index/view.json");
        $this->data = json_decode($this->viewFile, true);
        $this->header = $this->data['Header']['body'];
        $this->footer = $this->data['Footer']['body'];
        $this->controller = $_SERVER['REQUEST_URI'];
    }

    public function setData($key, $data)
    {
        $this->{$key} = $data;
        return $this;
    }

    public function render()
    {
        //todo parse relevant JSON file - and render its elements (for this controller path)

        extract([$this]);
        ob_start();
        include $this->header;
        foreach ($this->data[$this->controller] as $content) {
            include $content;
        }
        include $this->footer;
        return ob_get_clean();
    }
}
