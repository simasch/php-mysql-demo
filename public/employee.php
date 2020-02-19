<?php

use hr\repository\EmployeeRepository;

require __DIR__ . '/../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $employeeRepository = new EmployeeRepository();
    $employee = $employeeRepository->findById($id);

    $employee->first_name = $_POST['first_name'];
    $employee->last_name = $_POST['last_name'];

    $employeeRepository->save($employee);

    header("Location: employees.php");
} else {
    $id = $_GET['id'];

    $employeeRepository = new EmployeeRepository();
    $employee = $employeeRepository->findById($id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee <?= $employee->id ?></title>

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
                <h1>Employee <?= $employee->id ?></h1>
                <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="hidden" name="id" value="<?= $employee->id ?>">

                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input class="form-control" id="first_name" name="first_name"
                               value="<?= $employee->first_name ?>">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input class="form-control" id="last_name" name="last_name" value="<?= $employee->last_name ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    &nbsp;
                    <a href="employees.php">Back</a>
                </form>

            </div>
        </div>
    </div>
</main>

<?php include 'footer.php' ?>
</body>
</html>
