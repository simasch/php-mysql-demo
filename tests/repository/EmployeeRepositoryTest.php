<?php

namespace hr\tests\repository;

use PHPUnit\Framework\TestCase;
use hr\repository\EmployeeRepository;

class EmployeeRepositoryTest extends TestCase
{
    protected $repository;

    public function setUp(): void
    {
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