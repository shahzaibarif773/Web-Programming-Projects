<?php
session_start();

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $users = file("users.txt");

    foreach($users as $user){

        $data = explode("|", trim($user));

        if($data[2] == $username && $data[3] == $password){

            $_SESSION['user'] = $username;

            header("Location: dashboard.php");
            exit();
        }
    }

    echo "Invalid login!";
}
?>

<h2>Login Page</h2>

<form method="POST">
Username: <input type="text" name="username"><br><br>
Password: <input type="password" name="password"><br><br>

<input type="submit" name="login" value="Login">
</form>

<a href="signup.php">Create account</a>
