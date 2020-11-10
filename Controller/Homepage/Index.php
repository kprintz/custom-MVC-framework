<?php


namespace Controller\Homepage;


class Index
{

    public function execute()
    {
        ob_start();
        $beforeBlock = include_once 'View/templates/head.phtml';
        $afterBlock = include_once 'View/templates/index.phtml';
        $mainBlock = include_once 'View/templates/foot.phtml';
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}
