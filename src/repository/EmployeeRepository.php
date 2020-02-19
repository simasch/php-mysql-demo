<?php

namespace hr\repository;

use hr\Configuration;
use hr\model\Employee;
use mysqli;

class EmployeeRepository
{
    private $conn;

    public function __construct()
    {
        $config = new Configuration();

        $this->conn = new mysqli(
            $config->value('database.host'),
            $config->value('database.username'),
            $config->value('database.password'),
            $config->value('database.dbname'));

        if ($this->conn->connect_error) {
            die($this->conn->error);
        }
    }

    /**
     * @return Employee[]
     */
    public function findAll(): array
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