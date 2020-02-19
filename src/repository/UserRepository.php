<?php

namespace hr\repository;

use hr\Configuration;
use hr\model\Employee;
use PDO;
use PDOException;
use phpDocumentor\Reflection\Types\Null_;

class UserRepository
{
    public function login(string $user, string $password): bool
    {
        return $user == 'admin' && $password == 'admin';
    }
}