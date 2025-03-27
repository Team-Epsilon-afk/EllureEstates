<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ellure Estates - Home</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <img src="images/E.png" alt="Ellure Estates Logo" class="logo">
            <nav>
                <a href="buyer.php">Buy</a>
                <a href="seller.php">Sell</a>
                <a href="contact.php">Contact</a>
                <a href="login.php" class="btn-login">Login / Signup</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Welcome to Ellure Estates</h1>
            <p class="hero-subtitle">Your gateway to premium properties and luxurious living.</p>
            <a href="buyer.php" class="btn-primary">Explore Properties</a>
        </div>
    </section>

    <!-- Featured Communities -->
<section class="featured-communities">
    <h2>Featured Communities</h2>
    <div class="communities-grid">
        <div class="community-card">
            <img src="images/community1.jpg" alt="Community 1">
            <h3>Downtown Living</h3>
            <p>Experience the vibrant city life in our downtown properties.</p>
        </div>
        <div class="community-card">
            <img src="images/community2.jpg" alt="Community 2">
            <h3>Suburban Bliss</h3>
            <p>Find peace and tranquility in our suburban communities.</p>
        </div>
        <div class="community-card">
            <img src="images/community3.jpg" alt="Community 3">
            <h3>Beachside Retreats</h3>
            <p>Relax and unwind in our beachside properties.</p>
        </div>
    </div>
</section>

    <!-- Property Listings -->
    <section class="property-listings">
        <h2>Available Properties</h2>
        <div class="properties-grid">
            <?php
            // Fetch and display properties
            $query = "SELECT * FROM properties LIMIT 3"; // Example query
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='property-card'>";
                    echo "<img src='" . htmlspecialchars($row['photo_path']) . "' alt='Property Image'>";
                    echo "<h3>" . htmlspecialchars($row['property_name']) . "</h3>";
                    echo "<p>Location: " . htmlspecialchars($row['location']) . "</p>";
                    echo "<p>Price: $" . htmlspecialchars($row['price']) . "</p>";
                    echo "</div>";
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
</body>
</html>