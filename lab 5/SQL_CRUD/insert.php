<?php

include "db.php";

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$query = "INSERT INTO users (name,email,password)
          VALUES ('$name','$email','$password')";

mysqli_query($conn, $query);

header("Location: index.php");

?>
