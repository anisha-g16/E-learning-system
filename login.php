<?php
// Include database configuration
include '../includes/db-config.php';
session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the user exists in the database
    $query = "SELECT * FROM students WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    // If user exists and password is correct
    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['student_logged_in'] = true;
        $_SESSION['student_name'] = $user['name'];
        $_SESSION['student_id'] = $user['id'];

        // Redirect to the student dashboard
        header("Location: student-dashboard.php");
        exit();
    } else {
        // Display an error message if login fails
        $error_message = "Invalid email or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link rel="stylesheet" href="sd-style.css"> <!-- Make sure this path is correct -->
</head>
<body>
    <div class="container">
        <form action="login.php" method="POST">
            <h2>Student Login</h2>
            <div class="error">
                <?php if (!empty($error_message)) echo htmlspecialchars($error_message); ?>
            </div>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
        <a href="register.php">Don't have an account? Register here.</a>
        <a href="../index.php">Home page</a>
    </div>
</body>
</html>
