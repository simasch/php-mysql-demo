<?php

require_once 'employee_repository.php';

use repository\EmployeeRepository;

$employeeRepository = new EmployeeRepository();
$data = $employeeRepository->findAll();

?>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($row = $data->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['first_name'] ?></td>
            <td><?= $row['last_name'] ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<a href="employees.php" target="_blank">Export as JSON</a>