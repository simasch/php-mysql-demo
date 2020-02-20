<?php

require __DIR__ . '/../vendor/autoload.php';

include 'auth.inc.php';

use hr\model\Employee;
use hr\repository\EmployeeRepository;

$employeeRepository = new EmployeeRepository();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    if (empty($id)) {
        $employee = Employee::create($_POST['first_name'], $_POST['last_name'], $_POST['date_of_birth']);

        $employeeRepository->insert($employee);
    } else {
        $employee = $employeeRepository->findById($id);

        $employee->first_name = $_POST['first_name'];
        $employee->last_name = $_POST['last_name'];
        $employee->date_of_birth = $_POST['date_of_birth'];

        $employeeRepository->update($employee);
    }

    header("Location: employees.php");
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $employee = $employeeRepository->findById($id);
    } else {
        $employee = new Employee();
    }
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
include 'navigation.inc.php';
?>

<main>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Employee <?= $employee->id ?></h1>
                <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <input type="hidden" name="id" value="<?= $employee->id ?>">

                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input class="form-control" id="first_name" name="first_name"
                               value="<?= $employee->first_name ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input class="form-control" id="last_name" name="last_name" value="<?= $employee->last_name ?>"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                               value="<?= $employee->date_of_birth ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    &nbsp;
                    <a href="employees.php">Back</a>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.inc.php' ?>
</body>
</html>
