<?php

use hr\model\Employee;
use hr\repository\EmployeeRepository;

require_once '../../../autoload.php';


$employeeRepository = new EmployeeRepository();
$records = $employeeRepository->findAll();

if (!empty($_SERVER['HTTP_ACCEPT']) && $_SERVER['HTTP_ACCEPT'] == 'application/xml') {
    echo xml($records);
} else {
    echo json($records);
}

/**
 * @param Employee[] $records
 * @return string
 */
function json(array $records)
{
    header('Content-Type: application/json');

    $employees = [];
    foreach ($records as $record) {
        $employees[] = $record->jsonSerialize();
    }

    return json_encode($employees);
}

/**
 * @param Employee[] $records
 * @return mixed
 */
function xml(array $records)
{
    header('Content-Type: application/xml');

    $xml = new SimpleXMLElement('<employees/>');

    foreach ($records as $record) {
        $record->xmlSerialize($xml);
    }

    return $xml->asXML();
}
