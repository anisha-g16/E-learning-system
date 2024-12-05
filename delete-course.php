<?php
include '../includes/db-config.php';
session_start();

header('Content-Type: application/json');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit();
}

// Check if course_id is provided
if (isset($_POST['course_id'])) {
    $courseId = $_POST['course_id'];

    // Delete the course from the database
    $query = "DELETE FROM courses WHERE course_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $courseId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete course']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Course ID not provided']);
}

$conn->close();
?>
