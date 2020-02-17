<?php
require_once 'db.php';

$result = $conn->query('select id, first_name, last_name from employee') or die($conn->error);
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
    <?php
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['first_name'] ?></td>
            <td><?= $row['last_name'] ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>

<a href="employees.php" target="_blank">Export as JSON</a>