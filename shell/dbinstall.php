<?php
include_once 'autoloader.php';

$tableObj = new \DB\Calculations\Setup();
$tableObj->initialize();


echo "finished running shell installer\n";
