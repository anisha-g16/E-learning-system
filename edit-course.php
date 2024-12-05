<?php
include '../includes/db-config.php';
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.php");
    exit();
}

// Get course ID from the URL
$courseId = isset($_GET['course_id']) ? $_GET['course_id'] : 0;

// Fetch the course information
$query = "SELECT * FROM courses WHERE course_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $courseId);
$stmt->execute();
$result = $stmt->get_result();
$course = $result->fetch_assoc();
$stmt->close();

// If course is not found, display an error message
if (!$course) {
    echo "Course not found or invalid course ID.";
    exit();
}

// Update course details when the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $updateQuery = "UPDATE courses SET title = ?, description = ?, price = ? WHERE course_id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("ssdi", $title, $description, $price, $courseId);

    if ($updateStmt->execute()) {
        echo "Course updated successfully!";
    } else {
        echo "Error updating course.";
    }
    $updateStmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
    <!-- Link to the CSS file for styling -->
    <link rel="stylesheet" href="css/admin-course-style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Course</h2>
        <form action="" method="post">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($course['title']); ?>" required>
            
            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($course['description']); ?></textarea>
            
            <label for="price">Price (INR):</label>
            <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($course['price']); ?>" required>
            
            <button type="submit">Update Course</button>
        </form>
    </div>
</body>
</html>
