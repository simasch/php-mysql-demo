<?php
$conn = new mysqli('localhost', 'hr', 'hr', 'hr');

if ($conn->connect_error) {
    die($conn->error);
}

