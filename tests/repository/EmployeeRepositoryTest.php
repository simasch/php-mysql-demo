<?php

namespace hr\tests\repository;

use hr\repository\EmployeeRepository;
use PHPUnit\Framework\TestCase;

class EmployeeRepositoryTest extends TestCase
{
    protected $repository;

    public function setUp(): void
    {
        $GLOBALS['test'] = true;

        $this->repository = new EmployeeRepository();
    }

    public function testFindAll(): void
    {
        $employees = $this->repository->findAll();

        $this->assertEquals(2, count($employees));
    }

    public function testFindById(): void
    {
        $employee = $this->repository->findById(1);

        $this->assertEquals(1, $employee->id);
    }
}