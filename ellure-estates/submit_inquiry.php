<?php
include 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$property_id = $_POST['property_id'];

$sql = "INSERT INTO inquiries (property_id, buyer_name, buyer_email, buyer_phone, message) 
        VALUES ('$property_id', '$name', '$email', '$phone', '$message')";

if ($conn->query($sql)) {
    echo "Inquiry sent successfully!";
} else {
    echo "Error: " . $conn->error;
}
?>