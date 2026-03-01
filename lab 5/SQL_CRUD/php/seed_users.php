<?php
// Run this script ONCE to insert sample users into the `users` table.
// Place this file alongside your other PHP files and open it in the browser.

include "db.php"; // uses $conn from db.php

if (!$conn) {
    die("Database connection not available.");
}

echo "<h2>Seeding users table...</h2>";

// 5 sample users with realistic data
$users = [
    ["name" => "John Doe",      "email" => "john.doe@example.com",      "password" => "Password123"],
    ["name" => "Jane Smith",    "email" => "jane.smith@example.com",    "password" => "Password123"],
    ["name" => "Michael Brown", "email" => "michael.brown@example.com", "password" => "Password123"],
    ["name" => "Emily Johnson", "email" => "emily.johnson@example.com", "password" => "Password123"],
    ["name" => "David Wilson",  "email" => "david.wilson@example.com",  "password" => "Password123"],
];

foreach ($users as $user) {
    $name  = mysqli_real_escape_string($conn, $user['name']);
    $email = mysqli_real_escape_string($conn, $user['email']);

    // Hash the password securely
    $hashedPassword = password_hash($user['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";

    if (mysqli_query($conn, $sql)) {
        echo "Inserted user: " . htmlspecialchars($user['name']) . " (" . htmlspecialchars($user['email']) . ")<br>";
    } else {
        echo "Error inserting " . htmlspecialchars($user['email']) . ": " . mysqli_error($conn) . "<br>";
    }
}

mysqli_close($conn);

echo "<br><strong>Done seeding users.</strong>";
?>

