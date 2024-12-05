<?php
include '../includes/db-config.php';

// Define admin credentials
$adminUsername = 'admin'; // Use the username you want to set, e.g., 'admin'
$adminPassword = 'admin123'; // Replace with a strong password of your choice

// Hash the password securely
$hashedPassword = password_hash($adminPassword, PASSWORD_DEFAULT);

// Update the password in the `users` table for the specified username
$query = "UPDATE users SET password='$hashedPassword' WHERE username='$adminUsername'";

// If the username doesn't exist, insert it
if (mysqli_query($conn, $query) && mysqli_affected_rows($conn) === 0) {
    // Insert new admin record if no rows were affected (username doesn't exist)
    $query = "INSERT INTO users (username, password, role) VALUES ('$adminUsername', '$hashedPassword', 'admin')";
    mysqli_query($conn, $query);
}

// Check if the update/insert was successful
if (mysqli_affected_rows($conn) > 0) {
    echo "Admin user created/updated successfully!";
} else {
    echo "Error creating/updating admin user: " . mysqli_error($conn);
}
?>
