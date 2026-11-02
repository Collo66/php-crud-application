<?php
include 'dbconnection.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$error = "";

$stmt = $conn->prepare("SELECT * FROM tblusers WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("User not found. <a href='index.php'>Back</a>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['firstname'] ?? '');
    $lastName = trim($_POST['lastname'] ?? '');
    $mobile = trim($_POST['mobilenumber'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');

    $update = $conn->prepare(
        "UPDATE tblusers SET firstname=?, lastname=?, mobilenumber=?, email=?, address=? WHERE id=?"
    );

    $update->bind_param("sssssi", $firstName, $lastName, $mobile, $email, $address, $id);

    if ($update->execute()) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Update failed: " . $update->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>

<h2>Edit User</h2>

<?php if ($error): ?>
    <p><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST">

    First Name:<br>
    <input type="text" name="firstname" value="<?= htmlspecialchars($row['firstname']) ?>" required><br><br>

    Last Name:<br>
    <input type="text" name="lastname" value="<?= htmlspecialchars($row['lastname']) ?>" required><br><br>

    Mobile Number:<br>
    <input type="text" name="mobilenumber" value="<?= htmlspecialchars($row['mobilenumber']) ?>" required><br><br>

    Email:<br>
    <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required><br><br>

    Address:<br>
    <textarea name="address" required><?= htmlspecialchars($row['address']) ?></textarea><br><br>

    <button type="submit">Update User</button>

</form>

<a href="index.php">Cancel</a>

</body>
</html>