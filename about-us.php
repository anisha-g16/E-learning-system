<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - E-Learning System</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file -->
</head>
<body>
    <header>
        <!-- Navigation Bar -->
        <nav class="navbar">
            <div class="container">
                <div class="logo">
                    <a href="index.php">E-Learning</a>
                </div>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="courses.html">Courses</a></li>
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
    </header>

    <div class="container">
        <h1>About Us</h1>
        <p>Welcome to our E-Learning Platform! Our mission is to provide high-quality online education to students worldwide. We offer a wide range of courses designed to help learners improve their skills and knowledge in various fields.</p>

        <h2>Our Vision</h2>
        <p>Our vision is to make education accessible and affordable for everyone, empowering learners to achieve their goals and succeed in their careers.</p>

        <h2>Our Team</h2>
        <p>We are a team of experienced educators, developers, and industry professionals working together to create an engaging and effective learning experience. Our goal is to help students reach their full potential through innovative, online courses.</p>

        <h2>Contact Us</h2>
        <p>If you have any questions or feedback, feel free to reach out to us at <a href="mailto:info@elearning.com">info@elearning.com</a>.</p>
    </div>

    <footer>
        <!-- Footer Content -->
        <p>&copy; 2024 E-Learning System. All Rights Reserved.</p>
    </footer>
</body>
</html>
