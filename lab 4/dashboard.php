<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$users = file("users.txt");
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>

<style>

body{
    margin:0;
    font-family: Arial, sans-serif;
    background:#f4f6f9;
}

.header{
    background:#2c3e50;
    color:white;
    padding:15px;
    text-align:center;
}

.container{
    width:90%;
    margin:auto;
    margin-top:30px;
}

.welcome{
    font-size:20px;
    margin-bottom:15px;
}

.card{
    background:white;
    padding:20px;
    border-radius:8px;
    box-shadow:0 0 10px rgba(0,0,0,.1);
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#3498db;
    color:white;
    padding:10px;
}

td{
    padding:10px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

tr:hover{
    background:#f1f1f1;
}

.logout{
    display:inline-block;
    margin-top:20px;
    padding:10px 20px;
    background:#e74c3c;
    color:white;
    text-decoration:none;
    border-radius:5px;
}

.logout:hover{
    background:#c0392b;
}

.footer{
    margin-top:40px;
    text-align:center;
    color:#777;
}

</style>
</head>

<body>

<div class="header">
    <h2>Admin Dashboard</h2>
</div>

<div class="container">

    <div class="welcome">
        Welcome <strong><?php echo $_SESSION['user']; ?></strong>
    </div>

    <div class="card">

        <h3>All Users Data</h3>

        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Password</th>
                <th>Phone</th>
            </tr>

            <?php
            foreach($users as $user){
                $data = explode("|", trim($user));
                echo "<tr>";
                echo "<td>".$data[0]."</td>";
                echo "<td>".$data[1]."</td>";
                echo "<td>".$data[2]."</td>";
                echo "<td>".$data[3]."</td>";
                echo "<td>".$data[4]."</td>";
                echo "</tr>";
            }
            ?>

        </table>

        <a class="logout" href="logout.php">Logout</a>

    </div>

</div>

<div class="footer">
    © <?php echo date("Y"); ?> Simple PHP Dashboard
</div>

</body>
</html>
