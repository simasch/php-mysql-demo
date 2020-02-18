<?php

namespace repository;

use model\Employee;
use mysqli;

class EmployeeRepository
{

    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli('localhost', 'hr', 'hr', 'hr');

        if ($this->conn->connect_error) {
            die($this->conn->error);
        }
    }

    public function findAll()
    {
        $records = $this->conn->query('select id, first_name, last_name from employee') or die($this->conn->error);
        $employees = [];
        foreach ($records as $record) {
            $employee = new Employee();
            $employee->id = $record['id'];
            $employee->first_name = $record['first_name'];
            $employee->last_name = $record['last_name'];
            $employees[] = $employee;
        }
        return $employees;
    }
}