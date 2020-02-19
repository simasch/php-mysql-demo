<?php

namespace hr\test\controller;

use hr\controller\EmployeeController;
use PHPUnit\Framework\TestCase;

class EmployeeControllerTest extends TestCase
{
    protected $controller;

    public function setUp(): void
    {
        $this->controller = new EmployeeController();
    }

    public function testGetAllEmployeesAsXml()
    {
        $xml = $this->controller->getAllEmployeesAsXml();

        $expected = file_get_contents('tests-data/expected_employees.xml');

        $this->assertEquals($expected, $xml);
    }

    public function testGetAllEmployeesAsJson()
    {
        $json = $this->controller->getAllEmployeesAsJson();

        $expected = file_get_contents('tests-data/expected_employees.json');

        $this->assertEquals($expected, $json);
    }
}
