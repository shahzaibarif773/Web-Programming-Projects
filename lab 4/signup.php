<?php
session_start();

if(isset($_POST['signup'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

   
    if($name && $email && $username && $password && $phone){

     
        $data = $name."|".$email."|".$username."|".$password."|".$phone."\n";

        file_put_contents("users.txt", $data, FILE_APPEND);

        header("Location: login.php");
        exit();
    }
}
?>

<h2>Signup Page</h2>

<form method="POST">
Name: <input type="text" name="name"><br><br>
Email: <input type="email" name="email"><br><br>
Username: <input type="text" name="username"><br><br>
Password: <input type="password" name="password"><br><br>
Phone: <input type="text" name="phone"><br><br>

<input type="submit" name="signup" value="Signup">
</form>

<a href="login.php">Already have account? Login</a>
