<?php
include 'db.php';

$rooms_filter = isset($_GET['rooms']) ? $_GET['rooms'] : 0;
$proximity_filter = isset($_GET['proximity']) ? $_GET['proximity'] : 0;

$sql = "SELECT * FROM properties WHERE rooms >= $rooms_filter AND proximity_km <= $proximity_filter";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='property-card'>";
        echo "<img src='" . $row['photo_path'] . "' alt='" . $row['property_name'] . "'>";
        echo "<h3>" . $row['property_name'] . "</h3>";
        echo "<p>Rooms: " . $row['rooms'] . "</p>";
        echo "<p>Location: " . $row['location'] . "</p>";
        echo "<p>Proximity: " . $row['proximity_km'] . " km</p>";
        echo "<p>Seller: " . $row['seller_name'] . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No properties found.</p>";
}
?>