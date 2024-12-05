<?php
session_start();
include '../includes/db-config.php';

// Ensure the user is logged in
if (!isset($_SESSION['student_logged_in'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['student_id']; // Get logged-in user's ID

// Fetch payment history for the user
$query = "SELECT p.payment_id, c.title AS course_title, p.payment_date, p.status, c.price 
          FROM payments p
          JOIN courses c ON p.course_id = c.course_id
          WHERE p.user_id = ?";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    die("ERROR: Could not prepare SQL query.");
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$payment_history = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment History</title>
    <link rel="stylesheet" href="payment-history.css">
</head>
<body>
    <div class="container">
        <h1>Payment History</h1>
        <?php if (count($payment_history) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Course Title</th>
                        <th>Payment Date</th>
                        <th>Status</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($payment_history as $index => $payment): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($payment['course_title']); ?></td>
                            <td><?php echo htmlspecialchars($payment['payment_date']); ?></td>
                            <td><?php echo htmlspecialchars($payment['status']); ?></td>
                            <td><?php echo htmlspecialchars($payment['price']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No payment history available.</p>
        <?php endif; ?>
        <a href="student-dashboard.php" class="btn">Back to Dashboard</a>
    </div>
</body>
</html>
