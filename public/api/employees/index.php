<?php

require_once '../../auto_load.php';

use repository\EmployeeRepository;

$employeeRepository = new EmployeeRepository();
$records = $employeeRepository->findAll();

if (!empty($_SERVER['HTTP_ACCEPT']) && $_SERVER['HTTP_ACCEPT'] == 'application/xml') {
    echo xml($records);
} else {
    echo json($records);
}

function json(array $records)
{
    header('Content-Type: application/json');

    $employees = [];
    foreach ($records as $record) {
        $employees[] = $record->jsonSerialize();
    }

    return json_encode($employees);
}

function xml(array $records)
{
    header('Content-Type: application/xml');

    $xml = new SimpleXMLElement('<employees/>');

    foreach ($records as $record) {
        $record->xmlSerialize($xml);
    }

    return $xml->asXML();
}
