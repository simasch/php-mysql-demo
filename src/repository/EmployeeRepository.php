<?php

namespace hr\repository;

use Error;
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
            $employees[] = Employee::populate($record['id'], $record['first_name'], $record['last_name'], $record['date_of_birth']);
        }
        return $employees;
    }

    public function findById(int $id)
    {
        $stmt = $this->dbh->prepare("select id, first_name, last_name, date_of_birth from employee where id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        return Employee::populate($record['id'], $record['first_name'], $record['last_name'], $record['date_of_birth']);
    }

    public function insert(Employee $employee)
    {
        $this->dbh->beginTransaction();

        $stmt = $this->dbh->prepare('insert into employee (first_name, last_name, date_of_birth) 
                                            values (:first_name, :last_name, :date_of_birth)');

        if ($stmt->execute(array(
                'first_name' => $employee->first_name,
                'last_name' => $employee->last_name,
                'date_of_birth' => $employee->date_of_birth)
        )) {
            $this->dbh->commit();
        } else {
            die($stmt->errorCode());
        }
    }

    public function update(Employee $employee)
    {
        $this->dbh->beginTransaction();

        $stmt = $this->dbh->prepare('update employee 
                                     set first_name = :first_name, last_name = :last_name, date_of_birth = :date_of_birth 
                                     where id = :id');
        if ($stmt->execute($employee->toArray())) {
            $this->dbh->commit();
        } else {
            die($stmt->errorCode());
        }
    }

    public function deleteById(int $id)
    {
        $this->dbh->beginTransaction();

        $stmt = $this->dbh->prepare('delete employee where id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $this->dbh->commit();
    }
}