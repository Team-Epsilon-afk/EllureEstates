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
    $stmt = $conn->prepare("DELETE FROM saved_properties WHERE user_id = ? AND property_id = ?");
    $stmt->bind_param("ii", $user_id, $property_id);
    $stmt->execute();
}

header("Location: dashboard.php");
exit();
?>
