<?php
include 'db.php';
session_start();

$name = $_SESSION['user_name'] ?? null;
$picture = $_SESSION['user_profile_pic'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ellure Estates - Buy</title>

    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div class="header-container">
        <img src="images/E.png" alt="Ellure Estates Logo" class="logo">

        <div class="header-right">
            <nav>
                <a href="index.php">Home</a>
                <a href="buyer.php" class="active">Buy</a>
                <a href="seller.php">Sell</a>
                <a href="contact.php">Contact</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="dashboard.php">Dashboard</a>
                    <a href="logout.php" class="btn-login">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn-login">Login / Signup</a>
                <?php endif; ?>
            </nav>

            <?php if ($name && $picture): ?>
                <div class="user-info">
                    <img src="<?= htmlspecialchars($picture) ?>" alt="Profile Picture" class="profile-pic">
                    <span class="user-name"><?= htmlspecialchars($name) ?></span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</header>

<section class="hero">
    <div class="hero-bg">
        <img src="images/villa-hero.jpg" alt="Luxury Villa Background">
    </div>

    <div class="hero-overlay">
        <div class="hero-content">
            <h1 class="hero-title">Find Your Dream Home</h1>
            <p class="hero-subtitle">Explore our exclusive collection of luxury properties.</p>
        </div>

        <form id="filterForm" class="search-bar">
            <div class="filter-group">
                <label for="property-type">Property Type</label>
                <select id="property-type" name="property-type">
                    <option value="">Any</option>
                    <option value="apartment">Apartment</option>
                    <option value="villa">Villa</option>
                    <option value="townhouse">Townhouse</option>
                    <option value="house">House</option>
                    <option value="cottage">Cottage House</option>
                    <option value="beachhouse">Beach House</option>
                    <option value="loft">Loft</option>

                </select>
            </div>
            <div class="filter-group">
                <label for="bedrooms">Bedrooms</label>
                <select id="bedrooms" name="rooms">
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
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($row['location']) . "'>" . htmlspecialchars($row['location']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="button" id="applyFilters" class="btn-primary">Search</button>
        </form>
    </div>
</section>


<section class="property-listings">
    <h2>Featured Properties</h2>
    <div class="properties-grid" id="properties">
        <?php
$query = "SELECT id, property_name, rooms, location, price, photo_path, seller_name FROM properties";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    echo "<div class='property-card'>";
    echo "<img src='" . htmlspecialchars($row['photo_path']) . "' alt='Property Image'>";
    echo "<div class='property-details'>";
    echo "<h3>" . htmlspecialchars($row['property_name']) . "</h3>";
    echo "<p><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</p>";
    echo "<p><strong>Rooms:</strong> " . htmlspecialchars($row['rooms']) . "</p>";
    echo "<p><strong>Price:</strong> $" . htmlspecialchars($row['price']) . "</p>";
    echo "<p><strong>Seller:</strong> " . htmlspecialchars($row['seller_name']) . "</p>";
    echo "<form action='save_property.php' method='POST' class='save-form'>";
    echo "<input type='hidden' name='property_id' value='" . htmlspecialchars($row['id']) . "'>";

    echo "<button type='submit' class='btn-save'>Save</button>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
}
?>
    </div>
</section>

<footer>
    <div class="footer-container">
        <p>&copy; 2025 Ellure Estates. All rights reserved.</p>
        <nav>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
        </nav>
    </div>
</footer>

<script>
    document.getElementById('applyFilters').addEventListener('click', function () {
        const form = document.getElementById('filterForm');
        const params = new URLSearchParams(new FormData(form)).toString();

        fetch('filter.php?' + params)
            .then(response => response.text())
            .then(html => {
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = html;
                const newProperties = tempDiv.querySelector('#properties');
                if (newProperties) {
                    document.getElementById('properties').innerHTML = newProperties.innerHTML;
                }
            })
            .catch(error => console.error('Filter error:', error));
    });
</script>
</body>
</html>

