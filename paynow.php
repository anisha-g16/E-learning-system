<?php
session_start();
include '../includes/db-config.php';

// Ensure DB connection is valid
if ($conn === false) {
    die("ERROR: Could not connect to the database.");
}

// Get the course_id from the form or URL
$course_id = isset($_POST['course_id']) ? intval($_POST['course_id']) : 0;

// Check if the user is logged in
if (!isset($_SESSION['student_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Fetch course details
$query = "SELECT * FROM courses WHERE course_id = ?";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    die("ERROR: Failed to prepare SQL query.");
}
$stmt->bind_param("i", $course_id);
$stmt->execute();
$course_result = $stmt->get_result();
$course = $course_result->fetch_assoc();
$stmt->close();

// Simulate payment process (This should be replaced with actual payment API)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['payment_status'])) {
    $payment_status = $_POST['payment_status']; // 'success' or 'failed'
    
    // Collect payment details from the form
    $card_number = $_POST['card_number'];
    $expiry_date = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];
    $cardholder_name = $_POST['cardholder_name'];

    // Check if the user ID exists in the session
    if (isset($_SESSION['student_id'])) {
        $user_id = $_SESSION['student_id'];
    } else {
        if ($payment_status === 'failed') {
            echo "<script>
                    alert('Payment failed. Please try again.');
                    window.location.href = 'student-dashboard.php';
                  </script>";
            exit();
        } else {
            echo "Error: User ID not found.";
            exit();
        }
    }
    
    // If payment status is successful, save to database and allow access
    if ($payment_status === 'success') {
        // Prepare the payment query
        $payment_query = "INSERT INTO payments (user_id, course_id, status, card_number, expiry_date, cvv, cardholder_name, payment_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($payment_query);
        if ($stmt === false) {
            die("ERROR: Failed to prepare payment SQL query.");
        }
        
        // Bind parameters
        $current_date = date('Y-m-d H:i:s');
        $stmt->bind_param("iissssss", $user_id, $course_id, $payment_status, $card_number, $expiry_date, $cvv, $cardholder_name, $current_date);
        
        // Execute the payment query
        if ($stmt->execute()) {
            // Close the payment statement
            $stmt->close();

            // Enrollment successful, now update course access
            $enrollment_query = "INSERT INTO course_enrollments (user_id, course_id) VALUES (?, ?)";
            $stmt = $conn->prepare($enrollment_query);
            if ($stmt === false) {
                die("ERROR: Failed to prepare course enrollment query.");
            }
            $stmt->bind_param("ii", $user_id, $course_id);
            
            // Execute enrollment query and check for success
            if ($stmt->execute()) {
                // Close statement
                $stmt->close();
                
                // Redirect to course details page
                echo "<script>
                        alert('Payment successful. You now have access to this course.');
                        window.location.href = 'course-details.php?id=$course_id';
                      </script>";
                exit();
            } else {
                // Enrollment failed
                echo "<script>
                        alert('Enrollment failed. Please contact support.');
                        window.location.href = 'student-dashboard.php';
                      </script>";
                exit();
            }
        } else {
            // Payment insertion failed
            echo "<script>
                    alert('Payment failed. Please try again.');
                    window.location.href = 'student-dashboard.php';
                  </script>";
            exit();
        }
    } else {
        // Payment failed, show alert and redirect
        echo "<script>
                alert('Payment failed. Please try again.');
                window.location.href = 'student-dashboard.php';
              </script>";
        exit();
    }
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Payment</title>
    <link rel="stylesheet" href="std-style.css"> <!-- Link to CSS File -->
</head>
<body>
    <div class="container">
        <h2 class="main-heading">Payment for <?php echo htmlspecialchars($course['title']); ?> (<?php echo htmlspecialchars($course['price']); ?> INR)</h2>
        
        <!-- Payment Form -->
        <form action="paynow.php" method="POST" class="payment-form">
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">

            <div class="form-group">
                <label for="card_number">Card Number:</label>
                <input type="text" id="card_number" name="card_number" required class="input-field">
            </div>

            <div class="form-group">
                <label for="expiry_date">Expiry Date (MM/YY):</label>
                <input type="text" id="expiry_date" name="expiry_date" required class="input-field">
            </div>

            <div class="form-group">
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" required class="input-field">
            </div>

            <div class="form-group">
                <label for="cardholder_name">Cardholder Name:</label>
                <input type="text" id="cardholder_name" name="cardholder_name" required class="input-field">
            </div>

            <!-- Simulate Payment Status Buttons -->
            <div class="button-container">
                <button type="submit" name="payment_status" value="success" class="button success">Successful Payment</button>
                <button type="submit" name="payment_status" value="failed" class="button failed">Failed Payment</button>
            </div>
        </form>
    </div>
</body>
</html>
