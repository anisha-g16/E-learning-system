<?php
session_start();

// Check if the student is logged in
if (!isset($_SESSION['student_logged_in'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Include database configuration
include '../includes/db-config.php';

// Fetch courses from the database
$query = "SELECT * FROM courses";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="std-style.css"> <!-- Ensure this CSS file exists -->
</head>
<body>
    <div class="dashboard-container">
        <!-- Navigation Bar -->
        <nav class="navbar">
            <div class="nav-brand">Welcome, <?php echo htmlspecialchars($_SESSION['student_name']); ?>!</div>
            <ul>
                <li><a href="student-dashboard.php">Courses</a></li>
                <li><a href="payment-history.php">Payment History</a></li>
                <li><a href="edit-profile.php">Edit Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <!-- Main Content Area -->
        <div class="main-content">
            <h2>Available Courses</h2>
            <div class="courses-list">
                <?php if ($result && $result->num_rows > 0): ?>
                    <ul>
                        <?php while ($course = $result->fetch_assoc()): ?>
                            <li class="course-item">
                                <h3><?php echo htmlspecialchars($course['title']); ?></h3>
                                <p><?php echo htmlspecialchars($course['description']); ?></p>
                                <p><strong>Price:</strong> <?php echo htmlspecialchars($course['price']); ?> INR</p>
                                <a href="course-details.php?id=<?php echo $course['course_id']; ?>" class="button">View Course</a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p>No courses available at the moment.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
