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
        $this->viewFile = file_get_contents("View/view.json");
        $this->data = json_decode($this->viewFile, true);
        $this->controller = [explode('/', $_SERVER['REQUEST_URI'])][0][1];
        $this->header = $this->data['Header']['body'];
        $this->footer = $this->data['Footer'][$this->controller];
    }

    public function setData($key, $data)
    {
        $this->{$key} = $data;
        return $this;
    }

    public function render()
    {
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
