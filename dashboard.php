<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$name = $_SESSION['name'] ?? '';
$picture = $_SESSION['picture'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Ellure Estates</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: white;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #1f1f1f;
            padding: 10px 20px;
        }

        .logo {
            height: 40px;
        }

        nav a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
        }

        .btn-login {
            background-color: red !important;
            color: white !important;
            padding: 8px 16px;
            border-radius: 5px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            background: white;
        }

        .dashboard {
            text-align: center;
            padding: 40px 20px;
        }

        .dashboard-section {
            margin-top: 40px;
        }

        .properties-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .property-card {
            background-color: #1f1f1f;
            border-radius: 10px;
            padding: 15px;
            width: 280px;
            box-shadow: 0 0 10px rgba(255,255,255,0.1);
        }

        .property-card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 8px;
        }

        .property-actions {
            margin-top: 10px;
        }

        .property-actions a,
        .property-actions form {
            display: inline-block;
            margin-right: 10px;
        }

        .property-actions form button {
            background: red;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        footer {
            text-align: center;
            padding: 20px;
            margin-top: 40px;
            background: #1f1f1f;
        }

        footer nav a {
            color: #aaa;
            margin: 0 10px;
            text-decoration: none;
        }
    </style>
</head>
<body>

<header>
    <div class="header-container">
        <img src="images/E.png" alt="Ellure Estates Logo" class="logo">
        <div class="header-right">
            <nav>
                <a href="index.php">Home</a>
                <a href="buyer.php">Buy</a>
                <a href="seller.php">Sell</a>
                <a href="dashboard.php" class="active">Dashboard</a>
                <a href="logout.php" class="btn-login">Logout</a>
            </nav>
            <div class="user-profile">
                <?php if ($picture): ?>
                    <img src="<?= htmlspecialchars($picture) ?>" alt="Profile Picture">
                <?php endif; ?>
                <span><?= htmlspecialchars($name) ?></span>
            </div>
        </div>
    </div>
</header>

<main class="dashboard">
    <h1>Welcome to Your Dashboard</h1>

    <section class="dashboard-section">
        <h2>Your Listed Properties (Selling)</h2>
        <div class="properties-grid">
            <?php
            $query = "SELECT * FROM properties WHERE user_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) {
                echo "<p>You haven't listed any properties yet.</p>";
            } else {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='property-card'>";
                    echo "<img src='" . htmlspecialchars($row['photo_path']) . "' alt='Property'>";
                    echo "<h3>" . htmlspecialchars($row['property_name']) . "</h3>";
                    echo "<p><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</p>";
                    echo "<p><strong>Rooms:</strong> " . htmlspecialchars($row['rooms']) . "</p>";
                    echo "<p><strong>Price:</strong> $" . htmlspecialchars($row['price']) . "</p>";
                    if (isset($row['created_at'])) {
                        echo "<p><strong>Listed:</strong> " . date('M d, Y', strtotime($row['created_at'])) . "</p>";
                    }
                    echo "<div class='property-actions'>";
                    echo "<a href='edit_property.php?id=" . $row['id'] . "' style='color: #4db8ff;'>Edit</a>";
                    echo "<a href='delete_property.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")' style='color: red;'>Delete</a>";
                    echo "</div>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </section>

    <section class="dashboard-section">
        <h2>Properties You're Interested In (Buying)</h2>
        <div class="properties-grid">
            <?php
            $query = "
                SELECT p.*, sp.id AS saved_id
                FROM saved_properties sp
                JOIN properties p ON sp.property_id = p.id
                WHERE sp.user_id = ?
            ";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) {
                echo "<p>You haven't shown interest in any properties yet.</p>";
            } else {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='property-card'>";
                    echo "<img src='" . htmlspecialchars($row['photo_path']) . "' alt='Property'>";
                    echo "<h3>" . htmlspecialchars($row['property_name']) . "</h3>";
                    echo "<p><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</p>";
                    echo "<p><strong>Rooms:</strong> " . htmlspecialchars($row['rooms']) . "</p>";
                    echo "<p><strong>Price:</strong> $" . htmlspecialchars($row['price']) . "</p>";
                    echo "<div class='property-actions'>";
                    echo "<form method='POST' action='unsave_property.php'>";
                    echo "<input type='hidden' name='property_id' value='" . $row['id'] . "'>";
                    echo "<button type='submit'>Remove</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </section>
</main>

<footer>
    <div class="footer-container">
        <p>&copy; 2025 Ellure Estates. All rights reserved.</p>
        <nav>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
        </nav>
    </div>
</footer>

</body>
</html>
