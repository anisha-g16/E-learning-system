<?php
include '../includes/db-config.php';
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.php");
    exit();
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Insert course into the database
    $query = "INSERT INTO courses (title, description, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $title, $description, $price);
    
    if ($stmt->execute()) {
        echo "Course added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link rel="stylesheet" href="css/admin-course-style.css">
</head>
<body>
    <div class="container">
        <h2>Add New Course</h2>
        <form method="POST">
            <div>
                <label for="title">Course Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="description">Course Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div>
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" required>
            </div>
            <div>
                <button type="submit">Add Course</button>
            </div>
        </form>
    </div>
</body>
</html>
