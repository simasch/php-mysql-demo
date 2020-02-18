<?php

require_once '../auto_load.php';

use repository\EmployeeRepository;

if (!empty($_SERVER['HTTP_ACCEPT'])) {
    $accept = $_SERVER['HTTP_ACCEPT'];

    if ($accept == 'application/xml') {
        xml();
    } else {
        json();
    }
} else {
    json();
}

function json()
{
    header('Content-Type: application/json');

    $employeeRepository = new EmployeeRepository();
    $data = $employeeRepository->findAll();

    $employees = [];
    while ($row = $data->fetch_assoc()) {
        $employees[] = [
            'id' => $row['id'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name']
        ];
    }

    echo json_encode($employees);
}

function xml()
{
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

    echo $xml->asXML();
}
