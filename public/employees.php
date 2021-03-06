<?php

require __DIR__ . '/../vendor/autoload.php';

include 'auth.inc.php';

use hr\repository\EmployeeRepository;

$employeeRepository = new EmployeeRepository();
$employees = $employeeRepository->findAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employees</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<?php
$page = 'employees';
include 'navigation.inc.php';
?>

<main>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Employees</h1>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th><a href="employee.php">New</a></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($employees as $employee) { ?>
                        <tr>
                            <td><?= $employee->id ?></td>
                            <td><?= $employee->first_name ?></td>
                            <td><?= $employee->last_name ?></td>
                            <td><?= $employee->date_of_birth ?></td>
                            <td>
                                <a href="employee.php?id=<?= $employee->id ?>">Edit</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.inc.php' ?>
</body>
</html>