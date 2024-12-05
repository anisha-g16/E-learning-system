<?php
include '../includes/db-config.php';
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.php");
    exit();
}

// Fetch all courses from the database
$query = "SELECT * FROM courses";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses - Admin Dashboard</title>
    <!-- Link to the CSS file for styling -->
    <link rel="stylesheet" href="css/admin-course-style.css">
</head>
<body>
    <div class="container">
        <h2>Manage Courses</h2>
        <a href="add-course.php" class="button">Add New Course</a>

        <h3>Courses List</h3>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                    <th>details</th>

                </tr>
            </thead>
            <tbody id="courses-list">
                <?php while ($course = $result->fetch_assoc()) : ?>
                    <tr id="course-<?php echo $course['course_id']; ?>">
                        <td><?php echo htmlspecialchars($course['title']); ?></td>
                        <td><?php echo htmlspecialchars($course['description']); ?></td>
                        <td><?php echo htmlspecialchars($course['price']); ?> INR</td>
                        <td>
                            <a href="course-details.php?id=<?php echo $course['course_id']; ?>">View Details</a>
                        </td>

                        <td>
                            <a href="edit-course.php?course_id=<?php echo $course['course_id']; ?>">Edit</a> |
                            <a href="#" onclick="confirmDeleteCourse(<?php echo $course['course_id']; ?>); return false;">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- JavaScript for handling delete with AJAX -->
    <script>
        function confirmDeleteCourse(courseId) {
            if (confirm('Are you sure you want to delete this course?')) {
                deleteCourse(courseId);
            }
        }

        function deleteCourse(courseId) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete-course.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Check the response to confirm deletion
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Remove the course from the table if deletion was successful
                        var courseRow = document.getElementById('course-' + courseId);
                        if (courseRow) {
                            courseRow.remove();
                        }
                    } else {
                        alert('Error deleting course: ' + response.message);
                    }
                }
            };
            // Send the course ID to be deleted
            xhr.send("course_id=" + courseId);
        }
    </script>
</body>
</html>
