<?php
session_start();
include 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if email and password are set
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validate inputs (you can add more validation as needed)
        if (empty($email) || empty($password)) {
            echo "Please fill in all fields.";
        } else {
            // Query the database
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Verify password (assuming passwords are hashed)
                if (password_verify($password, $row['password'])) {
                    // Login successful
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['role'] = $row['role'];
                    header("Location: index.php"); // Redirect to homepage
                    exit();
                } else {
                    echo "Invalid credentials!";
                }
            } else {
                echo "Invalid credentials!";
            }
        }
    } else {
        echo "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ellure Estates</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <img src="images/E.png" alt="Ellure Estates Logo" class="logo">
            <nav>
                <a href="buyer.php">Buy</a>
                <a href="seller.php">Sell</a>
                <a href="contact.php">Contact</a>
            </nav>
        </div>
    </header>

    <!-- Login Form -->
    <section class="login-section">
        <div class="login-container">
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn-primary">Login</button>
            </form>
            <p>Don't have an account? <a href="signup.php">Sign up here</a>.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <p>&copy; 2023 Ellure Estates. All rights reserved.</p>
            <nav>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </nav>
        </div>
    </footer>
</body>
</html>