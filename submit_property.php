<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $seller_name = $_POST['seller_name'];
    $property_name = $_POST['property_name'];
    $rooms = $_POST['rooms'];
    $location = $_POST['location'];
    $proximity_km = $_POST['proximity_km'];

    // Ensure the images folder exists
    if (!is_dir('images')) {
        mkdir('images', 0755, true); // Create the folder with write permissions
    }

    // Handle file upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photo_name = basename($_FILES['photo']['name']);
        $photo_path = 'images/' . $photo_name;

        // Move the uploaded file to the images folder
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $photo_path)) {
            // Insert into database
            $sql = "INSERT INTO properties (seller_name, property_name, rooms, location, proximity_km, photo_path)
                    VALUES ('$seller_name', '$property_name', $rooms, '$location', $proximity_km, '$photo_path')";
            if ($conn->query($sql)) {
                echo "<p>Property listed successfu<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sellerName = $_POST['seller-name'];
    $propertyName = $_POST['property-name'];
    $propertyType = $_POST['property-type'];
    $rooms = $_POST['rooms'];
    $location = $_POST['location'];
    $proximity = $_POST['proximity'];
    $price = $_POST['price'];

    // Handle file upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the file is an image
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if ($check !== false) {
            // Move the file to the uploads directory
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
                echo "File uploaded successfully.";
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "File is not an image.";
        }
    } else {
        echo "No file uploaded or an error occurred.";
    }
}
?>lly!</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        } else {
            echo "<p>Error uploading photo. Please check folder permissions.</p>";
        }
    } else {
        echo "<p>No photo uploaded or there was an error with the upload.</p>";
    }
}
?>