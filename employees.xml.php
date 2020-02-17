<?php

require_once 'employee_repository.php';

use repository\EmployeeRepository;

header('Content-Type: application/xml');

$employeeRepository = new EmployeeRepository();
$data = $employeeRepository->findAll();

$xml = new SimpleXMLElement('<employees/>');

while ($row = $data->fetch_assoc()) {
    $employee = $xml->addChild('employee');
    $employee->addChild('id', $row['id']);
    $employee->addChild('first_name', $row['first_name']);
    $employee->addChild('last_name', $row['last_name']);
}

print $xml->asXML();
