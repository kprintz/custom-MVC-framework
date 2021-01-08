<?php

namespace Controller\Core;

use Model\Calculations\Calculations;
use Model\Calculations\CalculationsResource;
use Model\Users\UsersResource;

//todo this class controller endpoints - always should return a string JSON object (not a string HTML document)

/**
 * Parent class for all ajax controller actions - ensuring we only use those children to respond to ajax requests
 *
 * Class ControllerAjaxAbstract
 * @package Controller\Core
 */
abstract class ControllerAjaxAbstract extends ControllerAbstract
{

}