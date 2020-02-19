<?php

namespace hr\repository;

use hr\Configuration;
use hr\model\Employee;
use PDO;
use PDOException;

class EmployeeRepository
{
    private $dbh;

    public function __construct()
    {
        $config = new Configuration();

        $this->dbh = new PDO(
            $config->value('database.url'),
            $config->value('database.username'),
            $config->value('database.password'));
    }

    /**
     * @return Employee[]
     */
    public function findAll(): array
    {
        $records = $this->dbh->query('select id, first_name, last_name from employee');
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