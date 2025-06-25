<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CHN atelier - Products</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>

    .products-container {
  flex: 2 1 0%;
  min-width: 0;
}
.product-section {
  width: 100%;
  max-width: 1100px;
}
.product-section h2 {
  text-align: center;
  color: #3d405b;
  font-size: 2.2rem;
  letter-spacing: 1.5px;
  font-weight: 900;
}
.products {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
  gap: 2.2rem;
}
.product-card {
  background: linear-gradient(to bottom, #fbfbfb 0%, #f8f8fa 100%);
  border-radius: 18px;
  box-shadow: 0 4px 24px rgba(0,0,0,0.09);
  padding: 2rem 1.5rem 1.5rem 1.5rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  transition: transform 0.2s, box-shadow 0.2s;
  position: relative;
}
.product-card:hover {
  transform: translateY(-8px) scale(1.04);
  box-shadow: 0 12px 48px rgba(180,140,110,0.18);
}
.product-card img {
  width: 130px;
  height: 130px;
  object-fit: cover;
  border-radius: 14px;
  margin-bottom: 1.2rem;
  border: 2.5px solid #f3e7df;
  box-shadow: 0 2px 8px rgba(224,122,95,0.10);
}
.product-card h3 {
  margin: 0.7rem 0 0.4rem 0;
  color: #b48c6e;
  font-size: 1.25rem;
  font-weight: 700;
  text-align: center;
}
.product-card p {
  color: #444;
  margin-bottom: 1.3rem;
  font-size: 1.08rem;
}
.product-card button {
  background: linear-gradient(90deg, #b48c6e 60%, #e7c9a9 100%);
  color: #fff;
  border: none;
  border-radius: 25px;
  padding: 0.8rem 1.7rem;
  font-size: 1.05rem;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s, box-shadow 0.2s, transform 0.18s;
  box-shadow: 0 2px 8px rgba(180,140,110,0.10);
  margin-top: auto;
}

.product-card button:hover {
  background: linear-gradient(90deg, #a07a5c 60%, #d6b28c 100%);
  box-shadow: 0 4px 16px rgba(180,140,110,0.18);
  transform: scale(1.04);
}
    .star-rating .fa-star {
      color: #ccc;
      cursor: pointer;
      transition: color 0.2s;
    }
    .star-rating .fa-star.selected {
      color: #f8ce0b;
    }
    .rating-info {
      font-size: 0.9rem;
      color: #666;
      margin-top: 0.3rem;
    }
  </style>
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
  <div class="account-dropdown" id="accountDropdown">
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

  <!-- Main Content -->
  <div class="main-container">
    <!-- Sidebar Filters -->
    <aside class="sidebar">
      <h3>Filter by</h3>
      <div class="filter-group">
        <h4>Brands</h4>
        <label><input type="checkbox" value="BLK"> BLK Cosmetics</label>
        <label><input type="checkbox" value="Vice"> Vice Cosmetics</label>
        <label><input type="checkbox" value="Sunnies"> Sunnies Face</label>
        <label><input type="checkbox" value="Careline"> Careline</label>
        <label><input type="checkbox" value="Happy"> Happy Skin</label>
        <label><input type="checkbox" value="GRWM"> Grwm</label>
        <label><input type="checkbox" value="Colourette"> Colourette</label>
        <label><input type="checkbox" value="Brilliant"> Brilliant Skin</label>
        <label><input type="checkbox" value="Pili"> Pili Ani</label>
        <label><input type="checkbox" value="Bench"> Bench</label>
        <label><input type="checkbox" value="Penshoppe">Penshoppe</label>
        
      </div>
      <div class="filter-group">
        <h4>Makeup Types</h4>
        <label><input type="checkbox" value="Foundation"> Foundation</label>
        <label><input type="checkbox" value="Blush"> Blush</label>
        <label><input type="checkbox" value="Lipstick"> Lipstick</label>
        <label><input type="checkbox" value="Mascara"> Mascara</label>
      </div>
      <div class="filter-group">
        <h4>Skincare</h4>
        <label><input type="checkbox" value="Moisturizer"> Moisturizer</label>
        <label><input type="checkbox" value="Toner"> Toner</label>
        <label><input type="checkbox" value="Cleanser"> Cleanser</label>
        <label><input type="checkbox" value="SPF"> SPF</label>
      </div>
      <div class="filter-group">
        <h4>Perfume Types</h4>
        <label><input type="checkbox" value="Floral"> Floral</label>
        <label><input type="checkbox" value="Citrus"> Citrus</label>
        <label><input type="checkbox" value="Woody"> Woody</label>
        <label><input type="checkbox" value="Fresh"> Fresh</label>
      </div>
    </aside>

    <!-- Product Section -->
    <section class="product-content">
      <h2>All Products</h2>
      <div class="products-grid">
        <!-- Example Product Card -->
        <div class="product-card" data-category="skincare">
          <img src="images/care2.jpg" alt="CHN Glow Set">
          <h3>CHN Glow Set</h3>
            <p>S$ 148.00</p>
            <div style="flex: 1"></div>
            <button 
  onclick="<?php echo isset($_SESSION['username']) ? "addToCart('CHN Glow Set', 148)" : "showLoginPrompt()" ?>"
>
  Add to Cart
</button>
        </div>
        <div class="product-card" data-category="skincare">
          <img src="images/care1.jpeg" alt="CHN Glow Set">
          <h3>CHN Glow Set</h3>
          <p>S$ 148.00</p>
          <button 
  onclick="<?php echo isset($_SESSION['username']) ? "addToCart('CHN Glow Set', 148)" : "showLoginPrompt()" ?>"
>
  Add to Cart
</button>
        </div>
        <div class="product-card" data-category="skincare">
          <img src="images/col1.jpg" alt="CHN Glow Set">
          <h3>CHN Glow Set</h3>
          <p>S$ 148.00</p>
          <button 
  onclick="<?php echo isset($_SESSION['username']) ? "addToCart('CHN Glow Set', 148)" : "showLoginPrompt()" ?>"
>
  Add to Cart
</button>
        </div>
        <div class="product-card" data-category="skincare">
          <img src="images/care1.jpeg" alt="CHN Glow Set">
          <h3>CHN Glow Set</h3>
          <p>S$ 148.00</p>
          <button 
  onclick="<?php echo isset($_SESSION['username']) ? "addToCart('CHN Glow Set', 148)" : "showLoginPrompt()" ?>"
>
  Add to Cart
</button>
        </div>
        <div class="product-card" data-category="skincare">
          <img src="images/col1.jpg" alt="CHN Glow Set">
          <p>S$ 148.00</p>
          <button 
  onclick="<?php echo isset($_SESSION['username']) ? "addToCart('CHN Glow Set', 148)" : "showLoginPrompt()" ?>"
>
  Add to Cart
</button>
        </div>
        <div class="product-card" data-category="skincare">
          <img src="images/col1.jpg" alt="CHN Glow Set">
          <h3>CHN Glow Set</h3>
          <p>S$ 142.00</p>
          <button 
  onclick="<?php echo isset($_SESSION['username']) ? "addToCart('CHN Glow Set', 142)" : "showLoginPrompt()" ?>"
>
  Add to Cart
</button>
        </div>
        <div class="product-card" data-category="makeup">
          <img src="images/col1.jpg" alt="CHN Finish Set">
          <h3>CHN Finish Set</h3>
          <p>S$ 178.00</p>
          <button 
  onclick="<?php echo isset($_SESSION['username']) ? "addToCart('CHN Finish Set', 178)" : "showLoginPrompt()" ?>"
>
  Add to Cart
</button>
        </div>
        <div class="product-card" data-category="makeup">
          <img src="images/col2.jpg" alt="CHN Seduction Set">
          <h3>CHN Seduction Set</h3>
          <p>S$ 218.00</p>
          <button 
  onclick="<?php echo isset($_SESSION['username']) ? "addToCart('CHN Seduction Set', 218)" : "showLoginPrompt()" ?>"
>
  Add to Cart
</button>
        </div>
        <div class="product-card" data-category="makeup">
          <img src="images/col3.jpeg" alt="Vice Lipstick">
          <h3>Vice Lipstick</h3>
          <p>S$ 88.00</p>
          <button 
  onclick="<?php echo isset($_SESSION['username']) ? "addToCart('Vice Lipstick', 88)" : "showLoginPrompt()" ?>"
>
  Add to Cart
</button>
        </div>
        <div class="product-card" data-category="makeup">
          <img src="images/col4.png" alt="Careline Set">
          <h3>Careline Cosmetics</h3>
          <p>S$ 95.00</p>
          <button 
  onclick="<?php echo isset($_SESSION['username']) ? "addToCart('Careline Cosmetics', 95)" : "showLoginPrompt()" ?>"
>
  Add to Cart
</button>
        </div>
        <div class="product-card" data-category="skincare">
          <img src="images/grwm1.jpeg" alt="Sunnies Care Set">
          <h3>Sunnies Care Routine</h3>
          <p>S$ 142.00</p>
          <button 
  onclick="<?php echo isset($_SESSION['username']) ? "addToCart('Sunnies Care Routine', 142)" : "showLoginPrompt()" ?>"
>
  Add to Cart
</button>
        </div>
        <div class="product-card" data-category="perfume">
          <img src="images/blk1.jpeg" alt="Sunnies Perfume">
          <h3>Sunnies Perfume</h3>
          <p>S$ 128.00</p>
          <button 
  onclick="<?php echo isset($_SESSION['username']) ? "addToCart('Sunnies Perfume', 128)" : "showLoginPrompt()" ?>"
>
  Add to Cart
</button>
        </div>
        <div class="product-card" data-category="skincare">
          <img src="images/care1.jpeg" alt="Sunnies Care Set">
          <h3>Sunnies Care Routine</h3>
          <p>S$ 142.00</p>
          <button 
  onclick="<?php echo isset($_SESSION['username']) ? "addToCart('Sunnies Care Routine', 142)" : "showLoginPrompt()" ?>"
>
  Add to Cart
</button>
        </div>
        <div class="product-card" data-category="skincare">
          <img src="images/care2.jpg" alt="Sunnies Care Set">
          <h3>Sunnies Care Routine</h3>
          <p>S$ 142.00</p>
          <button 
  onclick="<?php echo isset($_SESSION['username']) ? "addToCart('Sunnies Care Routine', 142)" : "showLoginPrompt()" ?>"
>
  Add to Cart
</button>
        </div>
        <div class="product-card" data-category="makeup">
          <img src="images/vice1.jpeg" alt="Sunnies Care Set">
          <h3>Sunnies Care Routine</h3>
          <p>S$ 142.00</p>
          <button 
  onclick="<?php echo isset($_SESSION['username']) ? "addToCart('Sunnies Care Routine', 142)" : "showLoginPrompt()" ?>"
>
  Add to Cart
</button>
        </div>
        <div class="product-card" data-category="makeup">
          <img src="images/vice2.jpeg" alt="Sunnies Care Set">
          <h3>Sunnies Care Routine</h3>
          <p>S$ 142.00</p>
          <button 
  onclick="<?php echo isset($_SESSION['username']) ? "addToCart('Sunnies Care Routine', 142)" : "showLoginPrompt()" ?>"
>
  Add to Cart
</button>
        </div>

        <!-- Add more product cards here -->

      </div>
    </section>
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
