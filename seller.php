<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ellure Estates - List Your Property</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            color: #212529;
        }

        header {
            background-color: #1c1c1c;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            height: 45px;
        }

        nav a {
            color: #ffffff;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #f0a500;
        }

        .form-section {
            max-width: 800px;
            margin: 40px auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.08);
        }

        .form-section h2 {
            font-size: 28px;
            margin-bottom: 25px;
            color: #1c1c1c;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 16px;
        }

        .file-upload {
            margin-top: 10px;
        }

        .file-upload input[type="file"] {
            display: none;
        }

        .file-upload label {
            padding: 12px 20px;
            background-color: #007bff;
            color: #fff;
            border-radius: 6px;
            cursor: pointer;
            display: inline-block;
        }

        .file-upload label:hover {
            background-color: #0056b3;
        }

        button {
            width: 100%;
            padding: 14px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        footer {
            margin-top: 50px;
            text-align: center;
            background-color: #1c1c1c;
            padding: 20px;
            color: #ffffff;
        }

        footer a {
            color: #f0a500;
            margin: 0 10px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <img src="images/E.png" alt="Ellure Estates Logo" class="logo">
        <nav>
            <a href="index.php">Home</a>
            <a href="seller.php">Sell</a>
            <a href="contact.php">Contact</a>
        </nav>
    </header>

    <!-- Form Section -->
    <section class="form-section">
        <h2>List Your Property</h2>
        <form action="submit_property.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="seller-name">Seller Name</label>
                <input type="text" id="seller-name" name="seller-name" placeholder="Your full name" required>
            </div>

            <div class="form-group">
                <label for="property-name">Property Name</label>
                <input type="text" id="property-name" name="property-name" placeholder="Give your property a name" required>
            </div>

            <div class="form-group">
                <label for="property-type">Property Type</label>
                <select id="property-type" name="property-type" required>
                    <option value="apartment">Apartment</option>
                    <option value="villa">Villa</option>
                    <option value="townhouse">Townhouse</option>
                    <option value="house">House</option>
                    <option value="cabin">Cabin</option>
                    <option value="cottage">Cottage House</option>
                    <option value="beachhouse">Beach House</option>
                    <option value="loft">Loft</option>
                </select>
            </div>

            <div class="form-group">
                <label for="rooms">Number of Rooms</label>
                <input type="number" id="rooms" name="rooms" placeholder="e.g. 3" required>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" placeholder="City or community" required>
            </div>


            <div class="form-group">
                <label for="price">Price (USD)</label>
                <input type="text" id="price" name="price" placeholder="e.g. 250000" required>
            </div>

            <div class="form-group file-upload">
               <!-- <label for="photo">Property Photo</label>-->
                <input type="file" id="photo" name="photo" accept="image/*" required>
                <label for="photo" class="file-upload-label">Choose a photo</label>
            </div>

            <button type="submit">Submit Listing</button>
        </form>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Ellure Estates. All rights reserved.</p>
        <div>
            <a href="privacy-policy.php">Privacy Policy</a> |
            <a href="terms-of-service.php">Terms of Service</a>
        </div>
    </footer>

    <script>
        // File input label updater
        document.getElementById('photo').addEventListener('change', function () {
            const fileName = this.files[0] ? this.files[0].name : 'Choose a photo';
            document.querySelector('.file-upload-label').textContent = fileName;
        });
    </script>
</body>
</html>
