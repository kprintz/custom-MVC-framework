<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include_once 'autoloader.php';

$router = new \Controller\Core\Router($_SERVER['REQUEST_URI']);
echo $router->getResponse();