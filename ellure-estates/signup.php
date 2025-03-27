<?php
session_start();
include 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all required fields are set
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        // Validate inputs (you can add more validation as needed)
        if (empty($name) || empty($email) || empty($password) || empty($role)) {
            echo "Please fill in all fields.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user into the database
            $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);

            if ($stmt->execute()) {
                // Signup successful
                echo "Signup successful! Redirecting to login page...";
                header("Refresh: 2; url=login.php"); // Redirect to login page after 2 seconds
                exit();
            } else {
                echo "Error: " . $stmt->error;
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
    <title>Signup - Ellure Estates</title>
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

    <!-- Signup Form -->
    <section class="signup-section">
        <div class="signup-container">
            <h2>Sign Up</h2>
            <form action="signup.php" method="POST">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" required>
                        <option value="buyer">Buyer</option>
                        <option value="seller">Seller</option>
                    </select>
                </div>
                <button type="submit" class="btn-primary">Sign Up</button>
            </form>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
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