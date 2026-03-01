<?php
include "db.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP CRUD Example</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
    <h1 class="page-title">User Management</h1>
    <h2>Add User</h2>

    <form action="insert.php" method="POST" onsubmit="return confirm('Are you sure you want to add this user?');">
        Name: <input type="text" name="name" placeholder="Enter name" required>
        Email: <input type="email" name="email" placeholder="Enter email" required>
        Password: <input type="password" name="password" placeholder="Enter password" required>
        <button type="submit">Save</button>
    </form>

    <hr>

    <h2>User List</h2>

    <div class="user-list">
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Actions</th>
        </tr>

        <?php
        $query = "SELECT * FROM users";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $rowNum = 0;
            while($row = mysqli_fetch_assoc($result)){
                $rowNum++;
        ?>

        <tr class="user-row <?php echo $rowNum % 2 === 0 ? 'row-even' : ''; ?>">
            <td class="col-id"><?php echo htmlspecialchars($row['id']); ?></td>
            <td class="col-name"><?php echo htmlspecialchars($row['name']); ?></td>
            <td class="col-email"><?php echo htmlspecialchars($row['email']); ?></td>
            <td class="col-password"><?php echo htmlspecialchars(strlen($row['password']) > 20 ? substr($row['password'], 0, 20) . '…' : $row['password']); ?></td>
            <td class="col-actions">
                <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-edit" onclick="return confirm('Are you sure you want to edit this user?');">Edit</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
            </td>
        </tr>

        <?php
            }
        } else {
        ?>

        <tr>
            <td colspan="5" class="empty-state">No users found in the database.</td>
        </tr>

        <?php } ?>
    </table>
    </div>
</div>

</body>
</html>