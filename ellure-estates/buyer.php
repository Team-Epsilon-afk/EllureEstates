<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ellure Estates - Buy</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-left">
            <img src="images/E.png" alt="Ellure Estates Logo" class="logo">
            <nav>
                <a href="index.php">Home</a>
                <a href="seller.php">Sell</a>
                <a href="contact.php">Contact</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Find Your Dream Home</h1>
            <p class="hero-subtitle">Discover the perfect property for you and your family.</p>
            <form id="filterForm" class="search-bar">
                <div class="filter-group">
                    <label for="property-type">Property Type</label>
                    <select id="property-type" name="property-type">
                        <option value="">Any</option>
                        <option value="apartment">Apartment</option>
                        <option value="villa">Villa</option>
                        <option value="townhouse">Townhouse</option>
                        <option value="house">House</option>
                        <option value="cabin">Cabin</option>
                        <option value="loft">Loft</option>
                        <option value="cottage">Cottage</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="bedrooms">Bedrooms</label>
                    <select id="bedrooms" name="bedrooms">
                        <option value="">Any</option>
                        <option value="1">1 Bedroom</option>
                        <option value="2">2 Bedrooms</option>
                        <option value="3">3 Bedrooms</option>
                        <option value="4">4 Bedrooms</option>
                        <option value="5">5+ Bedrooms</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="price-range">Price Range</label>
                    <select id="price-range" name="price-range">
                        <option value="">Any</option>
                        <option value="100000">$100,000</option>
                        <option value="200000">$200,000</option>
                        <option value="300000">$300,000</option>
                        <option value="400000">$400,000</option>
                        <option value="500000">$500,000+</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="location">Location</label>
                    <select id="location" name="location">
                        <option value="">All Communities</option>
                        <?php
                        $sql = "SELECT DISTINCT location FROM properties";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($row['location']) . "'>" . htmlspecialchars($row['location']) . "</option>";
                            }
                        } else {
                            echo "<option value=''>No locations found</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="button" id="applyFilters" class="search-button">Apply Filters</button>
            </form>
        </div>
    </section>

    <!-- Property Listings -->
    <section class="property-listings">
        <h2>Available Properties</h2>
        <div id="properties" class="properties">
            <?php
            $query = "SELECT property_name, rooms, location, price, seller_name, photo_path FROM properties WHERE 1=1";

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $propertyType = $_POST['property-type'] ?? '';
                $bedrooms = $_POST['bedrooms'] ?? '';
                $priceRange = $_POST['price-range'] ?? '';
                $location = $_POST['location'] ?? '';

                if (!empty($propertyType)) {
                    $query .= " AND property_type = '" . $conn->real_escape_string($propertyType) . "'";
                }
                if (!empty($bedrooms)) {
                    $query .= " AND rooms = " . (int)$bedrooms;
                }
                if (!empty($priceRange)) {
                    $query .= " AND price <= " . (int)$priceRange;
                }
                if (!empty($location)) {
                    $query .= " AND location = '" . $conn->real_escape_string($location) . "'";
                }
            }

            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='property-card'>";
                    echo "<img src='" . htmlspecialchars($row['photo_path'] ?? 'images/default.jpg') . "' alt='Property Image'>";
                    echo "<div class='details'>";
                    echo "<h3>" . htmlspecialchars($row['property_name']) . "</h3>";
                    echo "<p>Rooms: " . htmlspecialchars($row['rooms']) . "</p>";
                    echo "<p>Location: " . htmlspecialchars($row['location']) . "</p>";
                    echo "<p>Price: $" . htmlspecialchars($row['price'] ?? 'N/A') . "</p>";
                    echo "<p>Seller: " . htmlspecialchars($row['seller_name']) . "</p>";
                    echo "</div></div>";
                }
            } else {
                echo "<p>No properties found based on filters.</p>";
            }
            ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Ellure Estates. All rights reserved.</p>
    </footer>

    <!-- JavaScript for Dynamic Filtering -->
    <script>
        document.getElementById('applyFilters').addEventListener('click', function () {
            const formData = new FormData(document.getElementById('filterForm'));

            fetch('', { method: 'POST', body: formData })
                .then(response => response.text())
                .then(html => {
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = html;
                    const newProperties = tempDiv.querySelector('#properties');
                    if (newProperties) {
                        document.getElementById('properties').innerHTML = newProperties.innerHTML;
                    } else {
                        document.getElementById('properties').innerHTML = '<p>No properties found based on filters.</p>';
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
