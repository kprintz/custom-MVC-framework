<?php

namespace Controller\Core;

abstract class ControllerIndexAbstract extends ControllerAbstract
{
    public string $HEADER = 'View/templates/head.phtml';
    public string $FOOTER = 'View/templates/foot.phtml';
}
