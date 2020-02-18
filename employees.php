<?php
require_once 'auto_load.php';

use repository\EmployeeRepository;

$employeeRepository = new EmployeeRepository();
$data = $employeeRepository->findAll();
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
include 'navigation.php';
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
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php' ?>
</body>
</html>