<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$property_id = $_POST['property_id'] ?? null;

if ($property_id) {
    // Prevent duplicate saves
    $check = $conn->prepare("SELECT * FROM saved_properties WHERE user_id = ? AND property_id = ?");
    $check->bind_param("ii", $user_id, $property_id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows === 0) {
        $stmt = $conn->prepare("INSERT INTO saved_properties (user_id, property_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $property_id);
        $stmt->execute();
    }
}

header("Location: buyer.php");
exit();
?>
