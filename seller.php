<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ellure Estates - Sell Property</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header .logo {
            height: 50px;
        }
        header nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }
        .seller-form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .seller-form h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .seller-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .seller-form input[type="text"],
        .seller-form input[type="number"],
        .seller-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .seller-form .file-upload {
            margin-bottom: 15px;
        }
        .seller-form .file-upload input[type="file"] {
            display: none;
        }
        .seller-form .file-upload label {
            display: inline-block;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }
        .seller-form .file-upload label:hover {
            background-color: #0056b3;
        }
        .seller-form button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .seller-form button:hover {
            background-color: #218838;
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
            margin-top: 20px;
        }
        footer a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }
    </style>
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

    <!-- Seller Form -->
    <div class="seller-form">
        <h2>Sell Your Property</h2>
        <form action="submit_property.php" method="POST" enctype="multipart/form-data">
            <label for="seller-name">Seller Name:</label>
            <input type="text" id="seller-name" name="seller-name" placeholder="Enter your name" required>

            <label for="property-name">Property Name:</label>
            <input type="text" id="property-name" name="property-name" placeholder="Enter property name" required>

            <!-- Added Property Type Field -->
            <label for="property-type">Property Type:</label>
            <select id="property-type" name="property-type" required>
                <option value="apartment">Apartment</option>
                <option value="villa">Villa</option>
                <option value="townhouse">Townhouse</option>
                <option value="house">House</option>
                <option value="cabin">Cabin</option>
            </select>

            <label for="rooms">Number of Rooms:</label>
            <input type="number" id="rooms" name="rooms" placeholder="Enter number of rooms" required>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location" placeholder="Enter location" required>

            <label for="proximity">Proximity (km):</label>
            <input type="number" id="proximity" name="proximity" placeholder="Enter proximity in km" required>
            
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" placeholder="Price" required>

            <!-- Photo Upload Section -->
            <div class="file-upload">
                <label for="photo">Upload Property Photo:</label>
                <input type="file" id="photo" name="photo" accept="image/*" required>
                <label for="photo" class="file-upload-label">Choose a file</label>
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2023 Ellure Estates. All rights reserved.</p>
        <p>
            <a href="privacy-policy.php">Privacy Policy</a> | 
            <a href="terms-of-service.php">Terms of Service</a>
        </p>
    </footer>

    <script>
        // Update file upload label with the selected file name
        document.getElementById('photo').addEventListener('change', function () {
            const fileName = this.files[0] ? this.files[0].name : 'No file chosen';
            document.querySelector('.file-upload-label').textContent = fileName;
        });
    </script>
</body>
</html>