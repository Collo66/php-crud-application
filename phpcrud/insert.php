<?php
include 'dbconnection.php';

$message = "";

if (isset($_POST['submit'])) {
    $firstName = trim($_POST['FirstName']);
    $lastName = trim($_POST['LastName']);
    $mobileNumber = trim($_POST['MobileNumber']);
    $email = trim($_POST['Email']);
    $address = trim($_POST['Address']);

    $stmt = $conn->prepare(
        "INSERT INTO tblusers (FirstName, LastName, MobileNumber, Email, Address)
         VALUES (?, ?, ?, ?, ?)"
    );

    $stmt->bind_param("sssss", $firstName, $lastName, $mobileNumber, $email, $address);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        $message = "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New User</title>
</head>
<body>

<h2>Add New User</h2>

<p><?php echo htmlspecialchars($message); ?></p>

<form method="POST">
    <label>First Name:</label><br>
    <input type="text" name="FirstName" required><br><br>

    <label>Last Name:</label><br>
    <input type="text" name="LastName" required><br><br>

    <label>Mobile Number:</label><br>
    <input type="text" name="MobileNumber" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="Email" required><br><br>

    <label>Address:</label><br>
    <textarea name="Address" required></textarea><br><br>

    <button type="submit" name="submit">Save User</button>
    <a href="index.php">Back</a>
</form>

</body>
</html>