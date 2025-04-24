<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ellure Estates - Contact Us</title>
  <link rel="stylesheet" href="css/styles.css">
  <style>
    :root {
      --primary-color: #1c1c1c;
      --accent-color: #004274;
      --light-bg: #f9f9f9;
      --text-color: #333;
      --font-main: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      margin: 0;
      font-family: var(--font-main);
      color: var(--text-color);
      background-color: var(--light-bg);
    }

    header {
      background-color: var(--primary-color);
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header .logo {
      height: 50px;
    }

    nav a {
      color: white;
      text-decoration: none;
      margin-left: 20px;
      font-size: 16px;
      transition: opacity 0.3s;
    }

    nav a:hover {
      opacity: 0.7;
    }

    .hero {
  background-image: url('images/contact.jpg'); /* Use your relative path */
  background-size: cover;
  background-position: center;
  height: 300px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.7);
}

    .hero h1 {
      font-size: 40px;
      margin: 0;
      font-weight: 600;
    }

    .contact-container {
      max-width: 960px;
      margin: 40px auto;
      background: white;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .contact-container h2 {
      font-size: 28px;
      margin-bottom: 20px;
      color: var(--accent-color);
    }

    .contact-container p {
      font-size: 16px;
      line-height: 1.6;
      margin-bottom: 20px;
    }

    .contact-container .email {
      font-size: 18px;
      font-weight: 500;
      color: var(--accent-color);
    }

    .contact-container .email a {
      color: var(--accent-color);
      text-decoration: none;
    }

    .contact-container .email a:hover {
      text-decoration: underline;
    }

    footer {
      background-color: var(--primary-color);
      color: white;
      text-align: center;
      padding: 30px 20px;
      margin-top: 60px;
    }

    footer a {
      color: white;
      text-decoration: none;
      margin: 0 10px;
      font-size: 14px;
    }

    footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <header>
    <div class="header-left">
      <img src="images/E.png" alt="Ellure Estates Logo" class="logo">
    </div>
    <nav>
      <a href="index.php">Home</a>
      <a href="seller.php">Sell</a>
      <a href="contact.php">Contact</a>
    </nav>
  </header>

  <section class="hero">
    <h1>Contact Us</h1>
  </section>

  <section class="contact-container">
    <h2>We're here to help</h2>
    <p>
      Welcome to Ellure Estates. Whether you're looking to buy your dream home or sell your property, we're committed to providing you with exceptional service.
    </p>
    <p>
      For inquiries or support, feel free to reach out. Our team is available to assist you promptly and professionally.
    </p>
    <div class="email">
      <strong>Email:</strong> <a href="mailto:ellureestate@gmail.com">ellureestate@gmail.com</a>
    </div>
    <p>We look forward to connecting with you.</p>
  </section>

  <footer>
    <p>&copy; 2023 Ellure Estates. All rights reserved.</p>
    <p>
      <a href="privacy-policy.php">Privacy Policy</a> | 
      <a href="terms-of-service.php">Terms of Service</a>
    </p>
  </footer>

</body>
</html>
