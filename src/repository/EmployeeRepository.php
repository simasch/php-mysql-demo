<?php

namespace hr\repository;

use hr\Configuration;
use hr\model\Employee;
use PDO;

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
        $stmt = $this->dbh->prepare("select id, first_name, last_name, date_of_birth from employee");
        $stmt->execute();
        $records = $stmt->fetchAll();

        $employees = [];
        foreach ($records as $record) {
            $employees[] = new Employee($record['id'], $record['first_name'], $record['last_name'], $record['date_of_birth']);
        }
        return $employees;
    }

    public function findById($id)
    {
        $stmt = $this->dbh->prepare("select id, first_name, last_name, date_of_birth from employee where id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Employee($record['id'], $record['first_name'], $record['last_name'], $record['date_of_birth']);
    }

    public function save(Employee $employee)
    {
        $this->dbh->beginTransaction();
        if ($employee->id != NULL) {
            $stmt = $this->dbh->prepare('update employee 
                                         set first_name = :first_name, last_name, date_of_birth = :date_of_birth 
                                        where id = :id');
            $stmt->bindParam(':id', $employee->id);
            $stmt->bindParam(':first_name', $employee->first_name);
            $stmt->bindParam(':last_name', $employee->last_name);
            $stmt->bindParam(':date_of_birth', $employee->date_of_birth);
            $stmt->execute();
        } else {
            $stmt = $this->dbh->prepare('insert into employee (first_name, last_name, date_of_birth)
                                                       values (:first_name, :last_name, :date_of_birth');
            $stmt->bindParam(':first_name', $employee->first_name);
            $stmt->bindParam(':last_name', $employee->last_name);
            $stmt->bindParam(':date_of_birth', $employee->date_of_birth);
            $stmt->execute();
        }
        $this->dbh->commit();
    }
}