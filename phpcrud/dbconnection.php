<?php
$conn = new mysqli("localhost", "your_username", "your_password", "your_database");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>