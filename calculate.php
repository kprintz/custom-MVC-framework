<?php
include_once 'autoloader.php';

//todo remove this, and route user/php logically, based on the request
// $_SERVER['REQUEST_URI']

$ip = $_SERVER['REMOTE_ADDR'];
$today = date("Y-m-d");

$testObj = new \Model\Calculations();
$testObj->addCalculation($ip, $today, '123456');

//todo look up how to use regex to remove punctuation from IP
//127.00.01.2
//125.65.4.8
//127.55.06.3
