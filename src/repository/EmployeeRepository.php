<?php

namespace hr\repository;

use hr\Configuration;
use hr\model\Employee;
use PDO;
use PDOException;
use phpDocumentor\Reflection\Types\Null_;

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
        $stmt = $this->dbh->prepare("select id, first_name, last_name from employee");
        $stmt->execute();
        $records = $stmt->fetchAll();

        $employees = [];
        foreach ($records as $record) {
            $employee = $this->createEmployee($record);
            $employees[] = $employee;
        }
        return $employees;
    }

    public function findById($id)
    {
        $stmt = $this->dbh->prepare("select id, first_name, last_name from employee where id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        return $this->createEmployee($record);
    }

    /**
     * @param $record
     * @return Employee
     */
    private function createEmployee($record): Employee
    {
        $employee = new Employee();
        $employee->id = $record['id'];
        $employee->first_name = $record['first_name'];
        $employee->last_name = $record['last_name'];
        return $employee;
    }

    public function save(Employee $employee)
    {
        $this->dbh->beginTransaction();
        if ($employee->id != NULL) {
            $stmt = $this->dbh->prepare('update employee set first_name = :first_name, last_name = :last_name where id = :id');
            $stmt->bindParam(':id', $employee->id);
            $stmt->bindParam(':first_name', $employee->first_name);
            $stmt->bindParam(':last_name', $employee->last_name);
            $stmt->execute();
        }
        else {
            $stmt = $this->dbh->prepare('insert into employee (first_name, last_name) values (::first_name, :last_name');
            $stmt->bindParam(':first_name', $employee->first_name);
            $stmt->bindParam(':last_name', $employee->last_name);
            $stmt->execute();
        }
        $this->dbh->commit();
    }
}