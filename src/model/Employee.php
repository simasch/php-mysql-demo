<?php

namespace hr\model;

use DateTime;
use JsonSerializable;
use SimpleXMLElement;

class Employee implements JsonSerializable
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
     */
    public function __construct(int $id, string $first_name, string $last_name, string $date_of_birth)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->date_of_birth = $date_of_birth;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
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
    public function xmlSerialize(SimpleXMLElement $xml)
    {
        $employee = $xml->addChild('employee');
        $employee->addChild('id', $this->id);
        $employee->addChild('first_name', $this->first_name);
        $employee->addChild('last_name', $this->last_name);
        $employee->addChild('date_of_birth', $this->date_of_birth);
    }
}