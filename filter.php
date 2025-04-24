<?php
include 'db.php';

$rooms_filter = isset($_GET['rooms']) ? intval($_GET['rooms']) : 0;
$property_type = isset($_GET['property-type']) ? $_GET['property-type'] : '';
$location = isset($_GET['location']) ? $_GET['location'] : '';
$price_range = isset($_GET['price-range']) ? intval($_GET['price-range']) : 0;

$conditions = ["rooms >= $rooms_filter"];

if (!empty($property_type)) {
    $conditions[] = "property_type = '" . $conn->real_escape_string($property_type) . "'";
}
if (!empty($location)) {
    $conditions[] = "location = '" . $conn->real_escape_string($location) . "'";
}
if ($price_range > 0) {
    if ($price_range >= 500000) {
        $conditions[] = "price >= 500000";
    } else {
        $conditions[] = "price <= $price_range";
    }
}

$sql = "SELECT * FROM properties";
if (!empty($conditions)) {
    $sql .= " WHERE " . implode(' AND ', $conditions);
}

$result = $conn->query($sql);

echo "<div id='properties'>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='property-card'>";
        echo "<img src='" . htmlspecialchars($row['photo_path']) . "' alt='" . htmlspecialchars($row['property_name']) . "'>";
        echo "<div class='property-details'>";
        echo "<h3>" . htmlspecialchars($row['property_name']) . "</h3>";
        echo "<p>Rooms: " . htmlspecialchars($row['rooms']) . "</p>";
        echo "<p>Location: " . htmlspecialchars($row['location']) . "</p>";
        echo "<p>Seller: " . htmlspecialchars($row['seller_name']) . "</p>";
        echo "<p>Price: $" . htmlspecialchars($row['price']) . "</p>";
        echo "</div></div>";
    }
} else {
    echo "<p>No properties found.</p>";
}
echo "</div>";
?>
