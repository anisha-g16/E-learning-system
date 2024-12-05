<?php
include '../includes/db-config.php';
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.php");
    exit();
}

// Retrieve course ID from URL
$course_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Debugging output to check the retrieved Course ID
// echo "Debug: Retrieved Course ID is: " . $course_id . "<br>";

$lessonAdded = false; // Flag to check if lesson was added successfully

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lesson_title = $_POST['lesson_title'];
    $video_url = $_POST['video_url'];
    $notes = $_POST['notes'];

    // Insert the new lesson into the database
    $query = "INSERT INTO lessons (course_id, lesson_title, video_url, notes) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }

    $stmt->bind_param("isss", $course_id, $lesson_title, $video_url, $notes);
    $stmt->execute();
    $stmt->close();

    // Set the flag to true if the lesson is added successfully
    $lessonAdded = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Lesson - Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin-course-style.css">
    <style>
        /* Simple modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .modal button {
            margin-top: 10px;
        }
    </style>
    <script>
        // Function to display the modal
        function showModal() {
            document.getElementById('successModal').style.display = 'flex';
        }

        // Function to hide the modal
        function closeModal() {
            document.getElementById('successModal').style.display = 'none';
            // Redirect to course details page
            window.location.href = 'course-details.php?course_id=<?php echo $course_id; ?>';
        }

        // Display modal if the lesson is successfully added
        window.onload = function() {
            <?php if ($lessonAdded) : ?>
                showModal();
            <?php endif; ?>
        };
    </script>
</head>
<body>
    <div class="container">
        <h2>Add New Lesson</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="lesson_title">Lesson Title:</label>
                <input type="text" name="lesson_title" id="lesson_title" required>
            </div>
            <div class="form-group">
                <label for="video_url">YouTube Video URL:</label>
                <input type="text" name="video_url" id="video_url" placeholder="Enter YouTube video URL" required>
            </div>
            <div class="form-group">
                <label for="notes">Notes:</label>
                <textarea name="notes" id="notes" rows="5"></textarea>
            </div>
            <button type="submit" class="button">Add Lesson</button>
        </form>
    </div>

    <!-- Modal for successful lesson addition -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <h3>Success!</h3>
            <p>The lesson has been added successfully.</p>
            <button onclick="closeModal()">OK</button>
        </div>
    </div>
</body>
</html>
