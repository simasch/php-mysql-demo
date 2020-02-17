<?php
include_once 'db.php';

header('Content-Type: application/json');

$result = $conn->query('select id, first_name, last_name from employee') or die($conn->error);

$employees = [];
while ($row = $result->fetch_assoc()) {
    $employee = array_push($employees, [
        'id' => $row['id'],
        'first_name' => $row['first_name'],
        'last_name' => $row['last_name']
    ]);
}

echo json_encode($employees);
