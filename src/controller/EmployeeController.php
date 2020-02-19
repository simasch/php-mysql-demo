<?php

namespace hr\controller;

use hr\model\Employee;
use hr\repository\EmployeeRepository;
use mysqli;
use SimpleXMLElement;

class EmployeeController
{
    private $employeeRepository;

    public function __construct()
    {
        $this->employeeRepository = new EmployeeRepository();
    }

    public function getAllEmployeesAsJson(): string
    {
        $records = $this->employeeRepository->findAll();

        $employees = [];
        foreach ($records as $record) {
            $employees[] = $record->jsonSerialize();
        }

        return json_encode($employees);
    }

    public function getAllEmployeesAsXml(): string
    {
        $records = $this->employeeRepository->findAll();

        $xml = new SimpleXMLElement('<employees/>');
        foreach ($records as $record) {
            $record->xmlSerialize($xml);
        }

        return $xml->asXML();
    }

}