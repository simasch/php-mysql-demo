<?php

require __DIR__ . '/../vendor/autoload.php';

use hr\repository\UserRepository;

session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userRepository = new UserRepository();
    if ($userRepository->login($_POST['user'], $_POST['password'])) {
        $_SESSION['user'] = $_POST['user'];
        header("Location: index.php");
    } else {
        $message = 'Login failed';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

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
                <h1>Login</h1>
                <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="user">User</label>
                        <input class="form-control" id="user" name="user">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    &nbsp;
                    <span style="color: red;"><?= $message ?></span>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.inc.php' ?>
</body>
</html>
