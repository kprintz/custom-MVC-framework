<?php
include_once 'DB/Core/DbConnect.php';
include_once 'Model/Calculations.php';

$ip = $_SERVER['REMOTE_ADDR'];
$today = date("Y-m-d");

$testObj = new \Model\Calculations();
$testObj->addCalculation($ip, $today, '123456');

//todo look up how to use regex to remove punctuation from IP
//127.00.01.2
//125.65.4.8

