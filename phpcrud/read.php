<?php
include 'dbconnection.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $conn->prepare("SELECT * FROM tblusers WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View User</title>
</head>
<body>

<h2>User Details</h2>

<?php if ($row): ?>

    <strong>ID:</strong> <?= htmlspecialchars($row['id']) ?><br><br>

    <strong>First Name:</strong> <?= htmlspecialchars($row['firstname']) ?><br><br>

    <strong>Last Name:</strong> <?= htmlspecialchars($row['lastname']) ?><br><br>

    <strong>Mobile Number:</strong> <?= htmlspecialchars($row['mobilenumber']) ?><br><br>

    <strong>Email:</strong> <?= htmlspecialchars($row['email']) ?><br><br>

    <strong>Address:</strong> <?= htmlspecialchars($row['address']) ?><br><br>

    <strong>Creation Date:</strong> <?= htmlspecialchars($row['creationdate']) ?><br><br>

<?php else: ?>

    <p>User not found.</p>

<?php endif; ?>

<a href="index.php">