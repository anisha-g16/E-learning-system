<?php
include '../includes/db-config.php';
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.php");
    exit();
}

// Get the student ID from the URL
$student_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the student's current information
$query = "SELECT * FROM students WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

// If student does not exist, redirect back
if (!$student) {
    header("Location: manage-student.php");
    exit();
}

// Handle form submission to update student information
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Update the student's information
    $update_query = "UPDATE students SET name = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssi", $name, $email, $student_id);
    $stmt->execute();
    $stmt->close();

    // Redirect back to the manage student page after update
    header("Location: manage-student.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="css/admin-course-style.css">
</head>

<body>
    <div class="admin-container">
        <h2>Edit Student</h2>
        <form method="POST" action="">
            <label for="name">Full Name:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($student['name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($student['email']); ?>" required>

            <button type="submit" class="button">Update Student</button>
        </form>
    </div>
</body>

</html>
