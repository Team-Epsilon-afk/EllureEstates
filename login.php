<?php
session_start();
require_once 'db.php';
require_once 'vendor/autoload.php';

// Google OAuth setup
$client = new Google_Client();
$client->setClientId('738915678001-cheesf0o1ragjj7nikk5jclp2kv9ak6p.apps.googleusercontent.com');
$client->setClientSecret('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'); // Replace with your actual secret
$client->setRedirectUri('http://localhost/ellure-estates/google-callback.php');
$client->addScope(['email', 'profile']);
$google_login_url = $client->createAuthUrl();

// Handle traditional login
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email && $password) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['name'] = $user['name'] ?? '';
                header("Location: index.php");
                exit;
            }
        }
        $error = "Invalid email or password.";
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Ellure Estates</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<!-- Login Section -->
<section class="login-section">
    <div class="login-container">
        <h2>Login to Your Account</h2>

        <?php if (!empty($error)): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST" class="login-form">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit" class="btn-primary">Login</button>
        </form>

        <div class="google-login">
            <p>or</p>
            <a href="<?= htmlspecialchars($google_login_url) ?>">
                <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" alt="Sign in with Google">
            </a>
        </div>

        <p class="signup-link">Don't have an account? <a href="signup.php">Sign up here</a>.</p>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="footer-container">
        <p>&copy; <?= date('Y') ?> Ellure Estates. All rights reserved.</p>
        <nav>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
        </nav>
    </div>
</footer>

</body>
</html>
