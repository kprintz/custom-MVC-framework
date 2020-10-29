<?php
include_once 'DB/Core/DbConnect.php';
include_once 'DB/Core/DbSetupInterface.php';

$tableObj = new \DB\Calculations\Setup();
$tableObj->initialize();


echo "finished running shell installer\n";