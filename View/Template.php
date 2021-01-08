<?php

namespace View;

class Template
{
    public function render(array $contents)
    {
        extract([$this]);
        ob_start();
        foreach ($contents as $content) {
            include $content;
        }
        return ob_get_clean();
    }
}