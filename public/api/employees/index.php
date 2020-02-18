<?php

require_once '../../auto_load.php';

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
        $employees[] = $record->jsonSerialize();
    }

    echo json_encode($employees);
}

function xml(array $records)
{
    header('Content-Type: application/xml');

    $xml = new SimpleXMLElement('<employees/>');

    foreach ($records as $record) {
        $xml->addChild($record->xmlSerialize($xml));
    }

    echo $xml->asXML();
}
