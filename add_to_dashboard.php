<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];
$name = $_SESSION['name'] ?? '';
$picture = $_SESSION['picture'] ?? '';

// Fetch saved (buying) properties
$savedQuery = $conn->prepare("
    SELECT p.* 
    FROM saved_properties sp 
    JOIN properties p ON sp.property_name = p.property_name 
    WHERE sp.user_id = ?
");
$savedQuery->bind_param("i", $userId);
$savedQuery->execute();
$savedProperties = $savedQuery->get_result();

// Fetch listed (selling) properties
$listedQuery = $conn->prepare("SELECT * FROM properties WHERE user_id = ?");
$listedQuery->bind_param("i", $userId);
$listedQuery->execute();
$listedProperties = $listedQuery->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Ellure Estates</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header>
    <div class="header-container">
        <img src="images/E.png" alt="Logo" class="logo">
        <nav>
            <a href="index.php">Home</a>
            <a href="buyer.php">Buy</a>
            <a href="seller.php">Sell</a>
            <a href="dashboard.php" class="active">Dashboard</a>
            <a href="logout.php">Logout</a>
        </nav>
        <?php if ($name && $picture): ?>
            <div class="user-profile">
                <img src="<?= htmlspecialchars($picture) ?>" alt="Profile Picture">
                <span><?= htmlspecialchars($name) ?></span>
            </div>
        <?php endif; ?>
    </div>
</header>

<main class="dashboard">
    <section class="saved-properties">
        <h2>Saved Properties (Buying)</h2>
        <div class="properties-grid">
            <?php if ($savedProperties->num_rows > 0): ?>
                <?php while ($row = $savedProperties->fetch_assoc()): ?>
                    <div class="property-card">
                        <img src="<?= htmlspecialchars($row['photo_path']) ?>" alt="Property">
                        <h3><?= htmlspecialchars($row['property_name']) ?></h3>
                        <p><strong>Location:</strong> <?= htmlspecialchars($row['location']) ?></p>
                        <p><strong>Rooms:</strong> <?= htmlspecialchars($row['rooms']) ?></p>
                        <p><strong>Price:</strong> $<?= htmlspecialchars($row['price']) ?></p>
                        <p><strong>Seller:</strong> <?= htmlspecialchars($row['seller_name']) ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No saved properties yet.</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="listed-properties">
        <h2>My Listings (Selling)</h2>
        <div class="properties-grid">
            <?php if ($listedProperties->num_rows > 0): ?>
                <?php while ($row = $listedProperties->fetch_assoc()): ?>
                    <div class="property-card">
                        <img src="<?= htmlspecialchars($row['photo_path']) ?>" alt="Property">
                        <h3><?= htmlspecialchars($row['property_name']) ?></h3>
                        <p><strong>Location:</strong> <?= htmlspecialchars($row['location']) ?></p>
                        <p><strong>Rooms:</strong> <?= htmlspecialchars($row['rooms']) ?></p>
                        <p><strong>Price:</strong> $<?= htmlspecialchars($row['price']) ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>You haven't listed any properties yet.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<footer>
    <div class="footer-container">
        <p>&copy; 2025 Ellure Estates. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
