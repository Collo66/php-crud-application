<?php
include 'dbconnection.php';

if (isset($_POST['delete'])) {
    $id = (int) $_POST['delete_id'];

    $stmt = $conn->prepare("DELETE FROM tblusers WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Delete failed: " . $stmt->error;
    }
}

$result = $conn->query("SELECT * FROM tblusers ORDER BY ID DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP CRUD Application</title>
    <style>
        body {
            font-family: Arial;
            margin: 30px;
            background: #f4f4f4;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #333;
            color: white;
        }

        a, button {
            padding: 7px 10px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .add {
            background: green;
            color: white;
            display: inline-block;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<h2>PHP CRUD Application</h2>

<a class="add" href="insert.php">Add New User</a>

<table>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Mobile Number</th>
        <th>Email</th>
        <th>Address</th>
        <th>Creation Date</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= htmlspecialchars($row['id']) ?></td>
<td><?= htmlspecialchars($row['firstname']) ?></td>
<td><?= htmlspecialchars($row['lastname']) ?></td>
<td><?= htmlspecialchars($row['mobilenumber']) ?></td>
<td><?= htmlspecialchars($row['email']) ?></td>
<td><?= htmlspecialchars($row['address']) ?></td>
<td><?= htmlspecialchars($row['creationdate']) ?></td>
        <td>
    <a href="read.php?id=<?= $row['id'] ?>">View</a>

    <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>

    <form method="POST" style="display:inline;">
        <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
        <button type="submit" name="delete" onclick="return confirm('Delete this user?')">
            Delete
        </button>
    </form>
</td>
    </tr>
    <?php } ?>

</table>

</body>
</html>