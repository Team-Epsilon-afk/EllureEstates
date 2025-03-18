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
                echo "<p>Property listed successfully!</p>";
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