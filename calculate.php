<?php
include_once 'dbconnect.class.php';
include_once 'calculationtable.class.php';

$ip = $_SERVER['REMOTE_ADDR'];
$today = date("Y-m-d");

$testObj = new CalculationTable();
$testObj->addCalculation($ip, $today, '123456');

//todo look up how to use regex to remove punctuation from IP
//127.00.01.2
//125.65.4.8

