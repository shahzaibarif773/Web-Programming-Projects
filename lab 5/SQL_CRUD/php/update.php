<?php
include "db.php";

$id = $_GET['id'];

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Basic update (no hashing change here to keep behavior consistent with your current app)
    $update = "UPDATE users
               SET name='$name', email='$email', password='$password'
               WHERE id='$id'";

    mysqli_query($conn, $update);

    header("Location: index.php");
    exit;
}

$query = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1 class="page-title">User Management</h1>
        <h2>Edit User</h2>

        <form method="POST" class="edit-form" onsubmit="return confirm('Save changes for this user?');">
            <label>
                <span>Name</span>
                <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
            </label>

            <label>
                <span>Email</span>
                <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
            </label>

            <label>
                <span>Password</span>
                <input type="password" name="password" value="<?php echo htmlspecialchars($row['password']); ?>" required>
            </label>

            <div class="edit-actions">
                <button type="submit" name="update">Update User</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>