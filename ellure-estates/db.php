<?php
$host = 'localhost';
$user = 'ellure_user';
$password = 'eleganceandallure@123';
$database = 'ellure_estates';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>