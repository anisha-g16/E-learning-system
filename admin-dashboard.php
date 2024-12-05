<?php
session_start();
include '../includes/db-config.php';

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin-login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../admin/admin-dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <header>
            <h1>Welcome to the Admin Dashboard</h1>
            <p>Hello, Admin! Manage your courses and content here.</p>
        </header>
        <nav class="admin-nav">
            <ul>
                <li><a href="manage-courses.php">Manage Courses</a></li>
                <li><a href="add-course.php">Add New Course</a></li>
                <li><a href="manage-student.php">Manage Users</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <div class="content">
            <section>
                <h2>Courses Overview</h2>
                <p>View, edit, or remove existing courses.</p>
                <a href="manage-courses.php" class="button">Go to Course Management</a>
            </section>
            <section>
                <h2>Add New Course</h2>
                <p>Create a new course and set pricing options.</p>
                <a href="add-course.php" class="button">Add a New Course</a>
            </section>
            <!-- <section>
                <h2>Manage Lessons</h2>
                <p>Add or remove lessons for each course, including videos and notes.</p>
                <a href="manage-lessons.php" class="button">Go to Lesson Management</a>
            </section> -->
        </div>
    </div>
</body>
</html>
