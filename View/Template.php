<?php

namespace View;

class Template
{
    public function setData($key, $data)
    {
        $this->{$key} = $data;
        return $this;
    }

    public function render()
    {
        //todo parse relevant JSON file - and render its elements (for this controller path)
        $viewJsonFile = file_get_contents("View/Calculations/Index/view.json");
        $data = json_decode($viewJsonFile, true);
        return $data['Calculations/Index']['test'];
    }
}
