<?php


namespace Controller\Data;


class Index
{
    public function execute()
    {
        //todo put in parent class (with router?)
        ob_start();
        $beforeBlock = include_once 'View/templates/head.phtml';
        $afterBlock = include_once 'View/templates/database_interface.phtml';
        $mainBlock = include_once 'View/templates/foot.phtml';
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}
