<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ellure Estates - Buy</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <img src="images/E.png" alt="Ellure Estates Logo" class="logo">
            <nav>
                <a href="index.php">Home</a>
                <a href="buyer.php" class="active">Buy</a>
                <a href="seller.php">Sell</a>
                <a href="contact.php">Contact</a>
                <a href="login.php" class="btn-login">Login / Signup</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Find Your Dream Home</h1>
            <p class="hero-subtitle">Explore our exclusive collection of luxury properties.</p>
            <form id="filterForm" class="search-bar">
                <div class="filter-group">
                    <label for="property-type">Property Type</label>
                    <select id="property-type" name="property-type">
                        <option value="">Any</option>
                        <option value="apartment">Apartment</option>
                        <option value="villa">Villa</option>
                        <option value="townhouse">Townhouse</option>
                        <option value="house">House</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="bedrooms">Bedrooms</label>
                    <select id="bedrooms" name="bedrooms">
                        <option value="">Any</option>
                        <option value="1">1 Bedroom</option>
                        <option value="2">2 Bedrooms</option>
                        <option value="3">3 Bedrooms</option>
                        <option value="4">4+ Bedrooms</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="price-range">Price Range</label>
                    <select id="price-range" name="price-range">
                        <option value="">Any</option>
                        <option value="100000">$100,000</option>
                        <option value="200000">$200,000</option>
                        <option value="300000">$300,000</option>
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
                <button type="button" id="applyFilters" class="btn-primary">Search</button>
            </form>
        </div>
    </section>

    <!-- Property Listings -->
    <section class="property-listings">
        <h2>Featured Properties</h2>
        <div class="properties-grid">
            <?php
            $query = "SELECT property_name, rooms, location, price, photo_path FROM properties LIMIT 6";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='property-card'>";
                    echo "<img src='" . htmlspecialchars($row['photo_path']) . "' alt='Property Image'>";
                    echo "<div class='property-details'>";
                    echo "<h3>" . htmlspecialchars($row['property_name']) . "</h3>";
                    echo "<p><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</p>";
                    echo "<p><strong>Rooms:</strong> " . htmlspecialchars($row['rooms']) . "</p>";
                    echo "<p><strong>Price:</strong> $" . htmlspecialchars($row['price']) . "</p>";
                    echo "</div></div>";
                }
            } else {
                echo "<p>No properties found.</p>";
            }
            ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <p>&copy; 2023 Ellure Estates. All rights reserved.</p>
            <nav>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </nav>
        </div>
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
                    const newProperties = tempDiv.querySelector('.properties-grid');
                    if (newProperties) {
                        document.querySelector('.properties-grid').innerHTML = newProperties.innerHTML;
                    } else {
                        document.querySelector('.properties-grid').innerHTML = '<p>No properties found based on filters.</p>';
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>