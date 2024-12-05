<?php
include '../includes/db-config.php';
session_start();

header('Content-Type: application/json');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit();
}

// Check if lesson_id is provided
if (isset($_POST['lesson_id'])) {
    $lessonId = $_POST['lesson_id'];

    // Delete the lesson from the database
    $query = "DELETE FROM lessons WHERE lesson_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $lessonId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete lesson']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Lesson ID not provided']);
}

$conn->close();
?>
