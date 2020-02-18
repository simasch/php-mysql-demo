<?php

require_once '../auto_load.php';

use repository\EmployeeRepository;

$employeeRepository = new EmployeeRepository();
$records = $employeeRepository->findAll();

if (!empty($_SERVER['HTTP_ACCEPT']) && $_SERVER['HTTP_ACCEPT'] == 'application/xml') {
    xml($records);
} else {
    json($records);
}

function json(array $records)
{
    header('Content-Type: application/json');

    $employees = [];
    foreach ($records as $record) {
        $employees[] = [
            'id' => $record->id,
            'first_name' => $record->first_name,
            'last_name' => $record->last_name
        ];
    }

    echo json_encode($employees);
}

function xml(array $records)
{
    header('Content-Type: application/xml');

    $xml = new SimpleXMLElement('<employees/>');

    foreach ($records as $record) {
        $employee = $xml->addChild('employee');
        $employee->addChild('id', $record->id);
        $employee->addChild('first_name', $record->first_name);
        $employee->addChild('last_name', $record->last_name);
    }

    echo $xml->asXML();
}
