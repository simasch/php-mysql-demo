<?php

require_once 'db.php';

header('Content-Type: application/xml');

$result = $conn->query('select id, first_name, last_name from employee') or die($conn->error);

$xml = new SimpleXMLElement('<employees/>');

while ($row = $result->fetch_assoc()) {
    $employee = $xml->addChild('employee');
    $employee->addChild('id', $row['id']);
    $employee->addChild('first_name', $row['first_name']);
    $employee->addChild('last_name', $row['last_name']);
}

print $xml->asXML();
