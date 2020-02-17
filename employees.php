<?php

require_once 'auto_load.php';

use repository\EmployeeRepository;

header('Content-Type: application/json');

$employeeRepository = new EmployeeRepository();
$data = $employeeRepository->findAll();

$employees = [];
while ($row = $data->fetch_assoc()) {
    $employees[] = [
        'id' => $row['id'],
        'first_name' => $row['first_name'],
        'last_name' => $row['last_name']
    ];
}

echo json_encode($employees);
