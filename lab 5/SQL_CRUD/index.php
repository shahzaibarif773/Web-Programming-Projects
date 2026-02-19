<?php
include "db.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP CRUD Example</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Add User</h2>

    <form action="insert.php" method="POST">
        Name: <input type="text" name="name" placeholder="Enter name" required>
        Email: <input type="email" name="email" placeholder="Enter email" required>
        Password: <input type="password" name="password" placeholder="Enter password" required>
        <button type="submit">Save</button>
    </form>

    <hr>

    <h2>User List</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Action</th>
        </tr>

        <?php
        $query = "SELECT * FROM users";
        $result = mysqli_query($conn, $query);

        while($row = mysqli_fetch_assoc($result)){
        ?>

        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td>
                <a href="update.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>

        <?php } ?>
    </table>
</div>

</body>
</html>