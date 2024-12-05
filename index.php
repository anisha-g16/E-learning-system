<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning System - Home</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file -->
</head>
<body>
    <!-- Navigation Bar with PHP for Admin Visibility -->
<nav class="navbar">
    <div class="container">
        <div class="logo">
            <a href="index.php">E-Learning System</a>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="student/login.php">Courses</a></li>
            <li><a href="about-us.php">About Us</a></li>
            <li><a href="student/login.php">Login</a></li>
            <li><a href="student/register.php">Sign In</a></li>
            <li><a href="admin/admin-login.php">Admin</a></li>
            <!-- Show Admin Link Only If Admin is Logged In -->
            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') : ?>
                <li><a href="admin.html" class="admin-link">Admin</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>


    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h2>Welcome to E-Learning System</h2>
            <p>Your gateway to quality education and learning resources.</p>
            <a href="courses.php" class="btn">Explore Courses</a>
        </div>
    </section>

    <!-- Featured Courses Section -->
    <section class="featured-courses">
        <div class="container">
            <h2>Featured Courses</h2>
            <div class="course-list">
                <div class="course-item">
                    <img src="photos/web-dev.jpg" alt="Course 1">
                    <h3>Mastering Web Development</h3>
                    <p>Learn to build websites from scratch using HTML, CSS, JavaScript, and PHP. Perfect for beginners and advanced learners alike.</p>
                </div>
                <div class="course-item">
                    <img src="photos/digital.jpg" alt="Course 2">
                    <h3>Digital Marketing Essentials</h3>
                    <p>Discover the secrets of SEO, social media marketing, and online advertising to become a digital marketing expert.</p>
                </div>
                <div class="course-item">
                    <img src="photos/Python-Symbol.png" alt="Course 3">
                    <h3>Python</h3>
                    <p>A step-by-step guide to learning Python programming, from basic syntax to complex algorithms.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 E-Learning System. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
