<?php
include '../includes/db-config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['student_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Get the student's current data from the session
$student_id = $_SESSION['student_id'] ?? null;

// Fetch current student data
$query = "SELECT * FROM students WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

// If student does not exist, redirect back
if (!$student) {
    header("Location: student-dashboard.php");
    exit();
}

// Update profile after form submission
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Basic validation
    if (empty($name) || empty($email)) {
        $error = "Name and email are required.";
    } else {
        // Update the student's information
        $update_query = "UPDATE students SET name = ?, email = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("sssi", $name, $email, $password, $student_id);
        $stmt->execute();
        $stmt->close();

        // Update session info with new data
        $_SESSION['student_name'] = $name;

        // Redirect back to the student dashboard
        header("Location: student-dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="sd-style.css"> <!-- Link your CSS file here -->
</head>

<body>
    <div class="container">
        <h2>Edit Profile</h2>
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="name">Full Name:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($student['name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($student['email']); ?>" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="<?php echo htmlspecialchars($student['password']); ?>" required>

            <button type="submit">Update Profile</button>
        </form>
        <nav>
            <ul>
                <li><a href="student-dashboard.php">Back to Dashboard</a></li>
            </ul>
        </nav>
    </div>
</body>

</html>
