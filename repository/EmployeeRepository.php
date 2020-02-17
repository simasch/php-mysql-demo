<?php

namespace repository;

use mysqli;

class EmployeeRepository
{

    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli('localhost', 'hr', 'hr', 'hr');

        if ($this->conn->connect_error) {
            die($this->conn->error);
        }
    }

    public function findAll()
    {
        $result = $this->conn->query('select id, first_name, last_name from employee') or die($this->conn->error);
        return $result;
    }
}