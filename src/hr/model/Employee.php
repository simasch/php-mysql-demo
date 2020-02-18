<?php

namespace hr\model;

use JsonSerializable;
use SimpleXMLElement;

class Employee implements JsonSerializable
{
    public int $id;
    public string $first_name;
    public string $last_name;

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