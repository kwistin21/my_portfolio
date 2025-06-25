<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About Us - CHN atelier</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
    </style>

  <!-- Header -->
  <header class="navbar">
    <div class="logo">
      <img src="images/CHN.png" alt="CHN atelier logo" class="logo-img" />
      <span class="logo-text">CHN atelier</span>
    </div>
    <form class="navbar-search" style="display: flex; align-items: center; margin: 0 1rem;">
      <input type="text" placeholder="Search products..." aria-label="Search" style="padding: 0.4rem 0.8rem; border-radius: 20px; border: 1px solid #ccc;">
      <button type="submit" style="background: none; border: none; margin-left: -2rem; cursor: pointer;">
        <i class="fa fa-search"></i>
      </button>
    </form>

<nav class="nav-links">
  <a href="home.php">Home</a>
  <a href="product.php">Products</a>
  <a href="about.php">About Us</a>
  <?php if (isset($_SESSION['username'])): ?>
    <li><a href="#" onclick="showLogoutConfirm(event)">Logout</a></li>
  <?php else: ?>
    <a href="login.php" class="login-btn">Login</a>
  <?php endif; ?>
</nav>

    <div class="cart-icon" aria-label="Shopping cart">🛒 <span id="cart-count">0</span></div>

    <div class="cart-dropdown" id="cartDropdown">
      <h4>Your Cart</h4>
      <ul id="cartItems"></ul>
      <p class="cart-total">Total: S$ <span id="cartTotal">0.00</span></p>
      <a href="#" class="checkout-btn">Checkout</a>
    </div>
<div class="account-container">
  <div class="account-icon" id="accountIcon" aria-label="Account">
    👤 <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>
  </div>
  <div class="account-dropdown" id="accountDropdown" style="display:none;">
  <ul>
    <?php if (isset($_SESSION['username'])): ?>
      <li><a href="#">My Profile</a></li>
      <li><a href="#">Orders</a></li>
      <li><a href="#">Wishlist</a></li>
      <li><a href="#">Settings</a></li>
      <li><a href="#" onclick="showLogoutConfirm(event)">Logout</a></li>
    <?php else: ?>
      <li><a href="login.php">Login</a></li>
      <li><a href="register.php">Register</a></li>
    <?php endif; ?>
  </ul>
</div>
</div>

  </header>

  <!-- Hero Section -->
  <section class="about-hero">
    <h1>About CHN atelier</h1>
    <p>Empowering Filipino beauty brands to shine on a global stage. 
        We believe in homegrown excellence, and our goal is to bring it to every doorstep.</p>
    <div class="hero-images">
      <img src="images/teams.jpg" alt="Beauty Team" />
      <img src="images/workshops.jpg" alt="Cosmetics Workshop" />
      <img src="images/collab.jpeg" alt="Team Collaboration" />
    </div>
  </section>

  <!-- Our Mission Section -->
  <section class="about-mission">
    <div class="mission-content">
      <h2>We make sure your idea & creation are delivered properly</h2>
      <p>CHN atelier serves as a curated marketplace celebrating the artistry of Filipino beauty products. 
        We carefully select skincare, makeup, and fragrances that meet high standards while supporting passionate local entrepreneurs.
        <br>At CHN atelier, we believe in the power of purpose-driven beauty. Our platform connects customers with homegrown brands that 
        prioritize quality, innovation, and authenticity. Each product in our collection undergoes a thoughtful selection process—ensuring 
        it’s not just trend-worthy but also safe, effective, and ethically crafted.
        <br>Through our e-commerce store, customers can easily explore and shop a wide range of Filipino-made products, read real reviews, 
        and discover the stories behind the brands. Whether you're looking to glow with clean skincare or make a bold statement with vibrant 
        makeup, CHN atelier brings the best of Filipino beauty to your fingertips—delivered with care and confidence.
</p>
    </div>
    <div class="mission-image">
      <img src="images/founder.jpg" alt="Founder working">
      <blockquote>
        “We are committed to making Filipino beauty known and trusted globally.”<br>
        <span>- Christine, Founder</span>
      </blockquote>
    </div>
  </section>

  <!-- Empower Section -->
  <section class="about-empower">
    <div class="empower-text">
      <h2>We empower local beauty makers</h2>
      <p>We connect emerging Filipino cosmetic and perfume brands with modern consumers, giving them a platform to be seen, heard, and celebrated. Through strategic partnerships, ethical sourcing, and conscious branding, we help your vision glow up.</p>
    </div>
    <div class="empower-quote">
      <p class="highlight-quote">
        “Supporting local is more than a choice, it’s a statement of pride and sustainability.”
      </p>
    </div>
  </section>

  <!-- Features Section -->
  <section class="about-features">
    <h2>What makes us stand out?</h2>
    <div class="feature-boxes">
      <div class="feature">
        <i class="fas fa-users"></i>
        <h3>Passionate Team</h3>
        <p>Our team consists of Filipino creatives who care about representation, diversity, and innovation in the beauty industry.</p>
      </div>
      <div class="feature">
        <i class="fas fa-bullseye"></i>
        <h3>Focused Mission</h3>
        <p>Our goal is clear: promote and elevate Filipino beauty brands with transparency and authenticity.</p>
      </div>
      <div class="feature">
        <i class="fas fa-star"></i>
        <h3>Trusted Brands</h3>
        <p>Every product on CHN atelier is quality-tested and highly rated by real customers who believe in local beauty power.</p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <div class="footer-wrapper">
    <!-- Footer -->
<footer class="site-footer">
    <div class="footer-links-wrapper">
      <div class="footer-links">
        <h4>Company</h4>
        <a href="about.html">About Us</a>
        <a href="#">Contact</a>
        <a href="#">FAQs</a>
      </div>
      <div class="footer-links">
        <h4>Legal</h4>
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
      </div>
      <div class="footer-social">
        <h4>Follow Us</h4>
        <div class="social-icons">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; 2025 CHN atelier. All rights reserved.</p>
    </div>
  </div>
</footer>

<!-- Logout Modal -->
<div id="logoutModal" class="modal" style="display:none;">
  <div class="modal-content">
    <span class="close" onclick="closeLogoutModal()">&times;</span>
    <h3>Sign Out</h3>
    <p>Are you sure you want to sign out?</p>
    <button onclick="window.location.href='logout.php'" class="confirm-logout">Yes, Sign Out</button>
    <button onclick="closeLogoutModal()" class="cancel-logout">Cancel</button>
  </div>
</div>

</body>
</html>
