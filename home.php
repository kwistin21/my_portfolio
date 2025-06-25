<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CHN atelier</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
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
        <a href="#" class="logout-btn" onclick="showLogoutConfirm(event)">Logout</a>
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
  <div class="account-icon" id="accountIcon">
    <i class="fa fa-user"></i>
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
  <section class="hero enhanced-hero-bg">
    <div class="hero-text">
      <h1>GLOW UP STARTS HERE</h1>
      <p>Clean formulas. Timeless shades. Effortless beauty. <br> Find your everyday essentials—all in one place.</p>
      <button onclick="window.location.href='product.php'">Shop Now</button>
    </div>
    <div class="hero-bg-animation"></div>
  </section>

  <div class="main-content">
    <!-- Product and Blog Layout -->
<section class="product-and-blog">
  <aside class="testimonials-sidebar">
    <h2>What Our Customers Say</h2>
    <div class="testimonial-cards">
      <div class="testimonial-card">
        <p>"Absolutely love the Glow Set! My skin feels amazing."</p>
        <span>- Jamie L.</span>
      </div>
      <div class="testimonial-card">
        <p>"Effortless beauty in every product. Highly recommend CHN atelier!"</p>
        <span>- Priya S.</span>
      </div>
      <div class="testimonial-card">
        <p>"Fast shipping and beautiful packaging. Will buy again."</p>
        <span>- Alex T.</span>
      </div>
    </div>
  </aside>

  <div class="product-section">
      <h2>MOST POPULAR SETS</h2>
        <div class="products">
          <div class="product-card" data-name="CHN Glow Set" data-category="skincare" tabindex="0">
            <img src="images/set3.png" alt="CHN Glow Set" />
            <h3>CHN Glow Set</h3>
            <p>S$ 148.00 - S$ 288.00</p>
            <button 
  onclick="<?php echo isset($_SESSION['username']) ? "addToCart('CHN Glow Set', 148)" : "showLoginPrompt()" ?>"
>
  Add to Cart
</button>
          </div>
          <div class="product-card" data-name="CHN Finish Set" data-category="makeup" tabindex="0">
            <img src="images/set1.png" alt="CHN Finish Set" />
            <h3>CHN Finish Set</h3>
            <p>S$ 178.00 - S$ 338.00</p>
            <button 
  onclick="<?php echo isset($_SESSION['username']) ? "addToCart('CHN Finish Set', 178)" : "showLoginPrompt()" ?>"
>
  Add to Cart
</button>
          </div>
          <div class="product-card" data-name="CHN Seduction Set" data-category="perfume" tabindex="0">
            <img src="images/set2.jpg" alt="CHN Seduction Set" />
            <h3>CHN Seduction Set</h3>
            <p>S$ 218.00 - S$ 418.00</p>
            <button 
  onclick="<?php echo isset($_SESSION['username']) ? "addToCart('CHN Seduction Set', 218)" : "showLoginPrompt()" ?>"
>
  Add to Cart
</button>
          </div>
        </div>
          <!-- Blog Sidebar -->
      </div>
      <aside class="blog-sidebar">
        <h2>From Our Blog</h2>
        <div class="blog-posts">
          <article class="blog-post">
        <h3>5 Tips for Glowing Skin</h3>
        <p>Discover the secrets to achieving a radiant complexion with our expert tips.</p>
        <a href="#" class="read-more">Read More</a>
          </article>
          <article class="blog-post">
        <h3>The Best Makeup Looks for Every Occasion</h3>
        <p>Get inspired by our curated makeup looks for every event on your calendar.</p>
        <a href="#" class="read-more">Read More</a>
          </article>
          <article class="blog-post">
        <h3>Fragrance Layering 101</h3>
        <p>Learn how to create a signature scent by layering your favorite fragrances.</p>
        <a href="#" class="read-more">Read More</a>
          </article>
        </div>
        <div class="blog-video-section">
          <h3>Watch: The secret behind Andrea's radiant skin.</h3>
          <video src="images/vid3.mp4" controls poster="images/blog-video-poster.jpg" style="width:100%;border-radius:8px;margin-top:1em;"></video>
        </div>
      </aside>
    </section>
      <!-- Ad Collage Section -->
      <section class="ads-banner">
        <h2>Featured Collections</h2>
        <div class="collage-with-descriptions">
          <div class="collage-item">
            <img src="images/care1.jpeg" alt="Gentle Skincare" class="img1">
            <div class="collage-desc">
              <h4>Careline Cosmetics Must-Haves</h4>
              <p>Your daily makeup starter kit—fun, vibrant, and made to express your style.</p>
            </div>
          </div>
          <div class="collage-item">
            <video src="images/vid4.mp4" controls autoplay muted loop class="video1"></video>
            <div class="collage-desc">
              <h4>Vice Cosmetics</h4>
              <p>Catch the flawless transformation powered by our exclusive collab in action.</p>
            </div>
          </div>
          <div class="collage-item">
            <img src="images/sf1.png" alt="Sun Protection" class="img2">
            <div class="collage-desc">
              <h4>Sunnies Face Care Picks</h4>
              <p>Hydrate, protect, and glow all day with lightweight formulas from Sunnies Face.</p>
            </div>
          </div>
          <div class="collage-item">
            <img src="images/grwm1.jpeg" alt="Bold Lips" class="img3">
            <div class="collage-desc">
              <h4>Bold Lips</h4>
              <p>Unleash your confidence with grwm long-lasting lip colors.</p>
            </div>
          </div>
          <div class="collage-item">
            <video src="images/vid5.mp4" controls autoplay muted loop class="video2"></video>
            <div class="collage-desc">
              <h4>Fragrance Moments</h4>
              <p>Level up with Aficionado's signature scents—long-lasting and confidently bold..</p>
            </div>
          </div>
        </div>
      </section>

    <!-- Brand Section -->
    <section class="brand-logos">
      <h2>Our Trusted Brands</h2>
      <div class="brands-row">
        <img src="images/logo1.jpg" alt="Brand 1 logo" loading="lazy">
        <img src="images/logo2.jpg" alt="Brand 2 logo" loading="lazy">
        <img src="images/logo3.jpeg" alt="Brand 3 logo" loading="lazy">
        <img src="images/logo4.png" alt="Brand 4 logo" loading="lazy">
        <img src="images/logo5.png" alt="Brand 5 logo" loading="lazy">
        <img src="images/logo6.jpg" alt="Brand 6 logo" loading="lazy">
        <img src="images/logo7.png" alt="Brand 7 logo" loading="lazy">
        <img src="images/logo8.png" alt="Brand 8 logo" loading="lazy">
        <img src="images/logo9.png" alt="Brand 9 logo" loading="lazy">
        <img src="images/logo10.jpeg" alt="Brand 10 logo" loading="lazy">
        <img src="images/logo11.jpg" alt="Brand 11 logo" loading="lazy">
        <img src="images/logo12.png" alt="Brand 12 logo" loading="lazy">
      </div>
    </section>

    <!-- Newsletter Signup -->
    <section class="newsletter-signup">
      <div class="newsletter-container">
        <h2>Stay in the Glow</h2>
        <p>Subscribe to our newsletter for exclusive offers and updates.</p>
        <form>
          <input type="email" placeholder="Enter your email" aria-label="Email address" required>
          <button type="submit">Subscribe</button>
        </form>
      </div>
      </section>
    </div>
  </div>
  
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

</div>
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
<script src="script.js"></script>
</body>
</html>
