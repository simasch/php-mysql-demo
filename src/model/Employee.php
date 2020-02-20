<?php

namespace hr\model;

use DateTime;
use SimpleXMLElement;

class Employee
{
    public $id;
    public $first_name;
    public $last_name;
    public $date_of_birth;

    /**
     * Employee constructor.
     * @param int $id
     * @param string $first_name
     * @param string $last_name
     * @param DateTime $date_of_birth
     * @return Employee
     */
    public static function populate(int $id, string $first_name, string $last_name, string $date_of_birth): Employee
    {
        $employee = new Employee();
        $employee->id = $id;
        $employee->first_name = $first_name;
        $employee->last_name = $last_name;
        $employee->date_of_birth = $date_of_birth;

        return $employee;
    }

    /**
     * Employee constructor.
     * @param int $id
     * @param string $first_name
     * @param string $last_name
     * @param DateTime $date_of_birth
     * @return Employee
     */
    public static function create(string $first_name, string $last_name, string $date_of_birth): Employee
    {
        $employee = new Employee();
        $employee->first_name = $first_name;
        $employee->last_name = $last_name;
        $employee->date_of_birth = $date_of_birth;

        return $employee;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'date_of_birth' => $this->date_of_birth
        ];
    }

    /**
     * @param SimpleXMLElement $xml
     */
    public function toXml(SimpleXMLElement $xml)
    {
        $employee = $xml->addChild('employee');
        $employee->addChild('id', $this->id);
        $employee->addChild('first_name', $this->first_name);
        $employee->addChild('last_name', $this->last_name);
        $employee->addChild('date_of_birth', $this->date_of_birth);
    }
}