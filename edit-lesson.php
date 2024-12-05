<?php
include '../includes/db-config.php';
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.php");
    exit();
}

// Retrieve lesson ID from URL
$lesson_id = isset($_GET['lesson_id']) ? intval($_GET['lesson_id']) : 0;

if ($lesson_id == 0) {
    die('Invalid lesson ID.');
}

// Fetch existing lesson data
$query = "SELECT * FROM lessons WHERE lesson_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $lesson_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('Lesson not found.');
}

$lesson = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lesson_title = $_POST['lesson_title'];
    $video_url = $_POST['video_url'];
    $notes = $_POST['notes'];

    // Update the lesson in the database
    $update_query = "UPDATE lessons SET lesson_title = ?, video_url = ?, notes = ? WHERE lesson_id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("sssi", $lesson_title, $video_url, $notes, $lesson_id);
    $update_stmt->execute();
    $update_stmt->close();

    // Redirect to the course details page after editing
    header("Location: course-details.php?course_id=" . $lesson['course_id']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lesson - Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin-course-style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Lesson</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="lesson_title">Lesson Title:</label>
                <input type="text" name="lesson_title" id="lesson_title" value="<?php echo htmlspecialchars($lesson['lesson_title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="video_url">YouTube Video URL:</label>
                <input type="text" name="video_url" id="video_url" value="<?php echo htmlspecialchars($lesson['video_url']); ?>" required>
            </div>
            <div class="form-group">
                <label for="notes">Notes:</label>
                <textarea name="notes" id="notes" rows="5"><?php echo htmlspecialchars($lesson['notes']); ?></textarea>
            </div>
            <button type="submit" class="button">Update Lesson</button>
        </form>
    </div>
</body>
</html>
