<?php
include '../includes/db-config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['student_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Retrieve the course ID from the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $course_id = intval($_GET['id']);
} else {
    echo "Invalid course ID.";
    exit();
}

// Fetch the course information
$query = "SELECT * FROM courses WHERE course_id = ?";
$stmt = $conn->prepare($query);

// Check if query preparation was successful
if (!$stmt) {
    die("Query preparation failed: " . $conn->error);
}

$stmt->bind_param("i", $course_id);
$stmt->execute();
$course_result = $stmt->get_result();
$course = $course_result->fetch_assoc();
$stmt->close();

// Check if the course exists
if (!$course) {
    echo "Course not found.";
    exit();
}

// Check if the course is free or paid
$is_free = ($course['price'] == 0);
$has_paid = false;

// Check if the user has paid for the course
if (!$is_free) {
    $user_id = $_SESSION['student_id']; // Assuming 'student_id' is set in session after login
    $payment_query = "SELECT * FROM payments WHERE user_id = ? AND course_id = ? AND status = 'success'";
    $stmt = $conn->prepare($payment_query);
    
    if (!$stmt) {
        die("Payment query preparation failed: " . $conn->error);
    }

    $stmt->bind_param("ii", $user_id, $course_id);
    $stmt->execute();
    $payment_result = $stmt->get_result();
    $has_paid = ($payment_result->num_rows > 0);
    $stmt->close();
}

// Fetch lessons for the specific course
$lessons_query = "SELECT * FROM lessons WHERE course_id = ?";
$stmt = $conn->prepare($lessons_query);

if (!$stmt) {
    die("Lessons query preparation failed: " . $conn->error);
}

$stmt->bind_param("i", $course_id);
$stmt->execute();
$lessons = $stmt->get_result();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
    <link rel="stylesheet" href="std-style.css">
</head>

<body>
<nav class="navbar">
            <div class="nav-brand">Welcome, <?php echo htmlspecialchars($_SESSION['student_name']); ?>!</div>
            <ul>
                <li><a href="student-dashboard.php">Courses</a></li>
                <li><a href="payment-history.php">Payment History</a></li>
                <li><a href="edit-profile.php">Edit Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    <div class="container">
        <h2>Course Details: <?php echo htmlspecialchars($course['title']); ?></h2>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($course['description']); ?></p>
        <p><strong>Price:</strong> <?php echo $is_free ? "Free" : htmlspecialchars($course['price']) . " INR"; ?></p>

        <!-- If the course is free or the user has paid, show the lessons -->
        <?php if ($is_free || $has_paid): ?>
            <h3>Lessons</h3>
            <div class="lessons-container">
            <?php while ($lesson = $lessons->fetch_assoc()) : ?>
                    <div class="lesson">
                        <h4><?php echo htmlspecialchars($lesson['lesson_title']); ?></h4>
                        
                        <!-- Embed YouTube Video -->
                        <?php
                        // Extract the YouTube video ID from the URL
                        $video_url = htmlspecialchars($lesson['video_url']);
                        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $video_url, $match);
                        $video_id = $match[1] ?? '';
                        ?>

                        <?php if (!empty($video_id)): ?>
                            <div class="video-container">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $video_id; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        <?php else: ?>
                            <p>Invalid YouTube URL</p>
                        <?php endif; ?>

                        <p><strong>Notes:</strong> <?php echo htmlspecialchars($lesson['notes']); ?></p>
                    </div>
                <?php endwhile; ?>
        <?php else: ?>
            <!-- If the course is paid and the user hasn't paid yet, show a payment button -->
            <h3>This is a paid course. Please make a payment to access the lessons.</h3>
            <form action="paynow.php" method="POST">
                <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                <button type="submit" class="button">Pay Now (<?php echo htmlspecialchars($course['price']); ?> INR)</button>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>
