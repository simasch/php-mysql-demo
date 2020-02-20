<?php

namespace hr\model;

use JsonSerializable;
use SimpleXMLElement;

class Employee implements JsonSerializable
{
    public $id;
    public $first_name;
    public $last_name;

    /**
     * Employee constructor.
     * @param $id
     * @param $first_name
     * @param $last_name
     */
    public function __construct(int $id, string $first_name, string $last_name)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name
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
    }
}