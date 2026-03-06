<?php
require_once '../config/db.php';

// This script resets the admin password to 'password123'
$username = 'admin';
$password_plain = 'password123';

// Generate a new hash using the current PHP environment's default algorithm
$password_hash = password_hash($password_plain, PASSWORD_DEFAULT);

// Check if the admin user exists first
$check_sql = "SELECT * FROM admins WHERE username = '$username'";
$result = $conn->query($check_sql);

if ($result->num_rows > 0) {
    // Update existing admin
    $sql = "UPDATE admins SET password = '$password_hash' WHERE username = '$username'";
    $action = "Updated";
} else {
    // Create admin if it doesn't exist (failsafe)
    $sql = "INSERT INTO admins (username, password) VALUES ('$username', '$password_hash')";
    $action = "Created";
}

if ($conn->query($sql) === TRUE) {
    echo "<div style='font-family: Arial, sans-serif; padding: 20px; text-align: center; margin-top: 50px;'>";
    echo "<h1 style='color: green;'>Success!</h1>";
    echo "<p>Admin account has been <strong>$action</strong>.</p>";
    echo "<p>Username: <strong>$username</strong></p>";
    echo "<p>Password: <strong>$password_plain</strong></p>";
    echo "<br><a href='index.php' style='padding: 10px 20px; background: #dc3545; color: white; text-decoration: none; border-radius: 5px;'>Go to Login</a>";
    echo "</div>";
} else {
    echo "Error: " . $conn->error;
}
?>