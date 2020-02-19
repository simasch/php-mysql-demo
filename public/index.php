<?php
session_start();
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
$page = 'index';
include 'navigation.inc.php';
?>

<main>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>HR</h1>
                <p class="lead">Welcome to the worlds best Human Resources Management system</p>
            </div>
        </div>
    </div>
</main>

<footer>

</footer>

<?php include 'footer.inc.php' ?>
</body>
</html>