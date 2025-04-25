<?php
session_start();
require_once 'vendor/autoload.php';
include 'db.php'; // Make sure this sets $conn

$client = new Google_Client();
$client->setClientId('');
$client->setClientSecret('');
$client->setRedirectUri('http://localhost/ellure-estates/google-callback.php');
$client->addScope('email');
$client->addScope('profile');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (isset($token['error'])) {
        echo "<h3>Authentication failed</h3>";
        echo "<pre>" . htmlspecialchars(print_r($token, true)) . "</pre>";
        exit;
    }

    $client->setAccessToken($token['access_token']);

    // Get user info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();

    $email = $google_account_info->email ?? null;
    $name = $google_account_info->name ?? null;
    $picture = $google_account_info->picture ?? 'images/default-avatar.png';

    if (!$email || !$name) {
        echo "Failed to retrieve user info.";
        exit;
    }

    // Check DB connection
    if (!$conn) {
        die("Database connection failed.");
    }

    // Check if user exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $insert = $conn->prepare("INSERT INTO users (name, email, role) VALUES (?, ?, 'buyer')");
        $insert->bind_param("ss", $name, $email);
        $insert->execute();
        $user_id = $insert->insert_id;
    } else {
        $user = $result->fetch_assoc();
        $user_id = $user['id'];
    }

    // Set session
    $_SESSION['user_id'] = $user_id;
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;
    $_SESSION['picture'] = $picture;
    $_SESSION['role'] = 'buyer';

    // Redirect to homepage
    header('Location: index.php');
    exit;
} else {
    // Redirect to login with error
    header('Location: login.php?error=google_auth');
    exit;
}
