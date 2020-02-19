<?php

use hr\controller\EmployeeController;

require __DIR__ . '/../../../vendor/autoload.php';

$employeeController = new EmployeeController();

if (!empty($_SERVER['HTTP_ACCEPT']) && $_SERVER['HTTP_ACCEPT'] == 'application/xml') {
    header('Content-Type: application/xml');
    echo $employeeController->getAllEmployeesAsXml();
} else {
    header('Content-Type: application/json');
    echo $employeeController->getAllEmployeesAsJson();
}

