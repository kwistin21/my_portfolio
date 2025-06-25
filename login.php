<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - CHN atelier</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f8f8fa;
    }

    /* Navbar Styling */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 2rem;
      background-color: #fff;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      flex-wrap: wrap;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .logo img {
      height: 40px;
    }

    .nav-links a {
      margin: 0 0.8rem;
      text-decoration: none;
      color: #333;
      font-weight: 500;
    }

    .login-btn {
      font-weight: bold;
      color: #e89ab5;
    }

    .cart-icon {
      cursor: pointer;
    }

    .login-page {
      display: flex;
      flex-direction: row;
      align-items: stretch;
      justify-content: center;
      min-height: 100vh;
      padding: 2rem;
      gap: 2rem;
      background: linear-gradient(to bottom, #f49378 0%, #f8f8fa 100%);
      flex-wrap: wrap;
    }

    .auth-wrapper {
      display: flex;
      flex-direction: row;
      flex-wrap: wrap;
      justify-content: center;
      gap: 2rem;
      width: 100%;
      max-width: 1100px;
    }

    .video-container video {
      max-width: 100%;
      height: auto;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .video-container {
      flex: 1 1 400px;
    }

    .auth-container {
      flex: 1 1 400px;
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .auth-container h2 {
      margin-bottom: 1.5rem;
      color: #d47aa0;
      text-align: center;
    }

    .auth-form {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .auth-form input {
      padding: 0.75rem;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 1rem;
    }

    .auth-form button {
      padding: 0.75rem;
      border-radius: 5px;
      border: none;
      background: #e89ab5;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .auth-form button:hover {
      background: #d47aa0;
    }

    .auth-alert {
      padding: 1rem;
      background-color: #fff0f3;
      color: #e53935;
      border-left: 4px solid #e07a5f;
      border-radius: 5px;
      margin-bottom: 1rem;
      font-weight: bold;
    }

    .auth-alert.success {
      color: #43a047;
      border-left-color: #43a047;
    }

    .social-login {
      text-align: center;
    }

    .social-btn {
      margin: 0.5rem 0;
      width: 100%;
      padding: 0.6rem;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      font-size: 1rem;
      cursor: pointer;
    }

    .google-btn {
      background: #fff;
      border: 1px solid #ccc;
    }

    .facebook-btn {
      background: #1877f2;
      color: #fff;
    }

    .form-switch {
      text-align: center;
      margin-top: 1rem;
    }

    .form-switch a button {
      background: transparent;
      border: 1px solid #e89ab5;
      color: #e89ab5;
      padding: 0.5rem 1rem;
      border-radius: 5px;
      cursor: pointer;
    }

    .form-switch a button:hover {
      background: #e89ab5;
      color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .auth-wrapper {
        flex-direction: column;
        align-items: center;
      }

      .navbar {
        flex-direction: column;
        align-items: flex-start;
      }

      .navbar-search {
        width: 100%;
        margin: 1rem 0;
      }

      .video-container video {
        max-height: 300px;
      }
    }

    @media (max-width: 480px) {
      .auth-container {
        padding: 1.5rem;
      }

      .auth-form input, .auth-form button {
        font-size: 0.9rem;
      }
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

<main class="login-page">
  <div class="auth-wrapper">
    <!-- Left Video Panel -->
    <div class="video-container">
      <video autoplay muted loop playsinline>
        <source src="images/vid1.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    </div>

    <!-- Right Login Form -->
    <div class="auth-container">
      <h2>Welcome back, Muses!</h2>

      <?php
        if (isset($_SESSION['error'])) {
          echo '<div class="auth-alert error">'.htmlspecialchars($_SESSION['error']).'</div>';
          unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
          echo '<div class="auth-alert success">'.htmlspecialchars($_SESSION['success']).'</div>';
          unset($_SESSION['success']);
        }
      ?>

      

      <form class="auth-form" action="login_process.php" method="POST">
        <input type="text" name="username" placeholder="Username" required autofocus>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>

        <div class="social-login">
          <p>Or Login with:</p>
          <button type="button" class="social-btn google-btn"
            onclick="window.location.href='https://accounts.google.com/o/oauth2/v2/auth?client_id=YOUR_CLIENT_ID&redirect_uri=YOUR_REDIRECT_URI&response_type=code&scope=email%20profile'">
            <i class="fab fa-google" style="color: red;"></i> Google
          </button>

          <button type="button" class="social-btn facebook-btn"
            onclick="window.location.href='https://www.facebook.com/v19.0/dialog/oauth?client_id=YOUR_APP_ID&redirect_uri=YOUR_REDIRECT_URI&scope=email'">
            <i class="fab fa-facebook-f"></i> Facebook
          </button>
        </div>

        <div class="form-switch">
          <span>Don't have an account?</span>
          <a href="register.php"><button type="button">Register</button></a>
        </div>
      </form>
    </div>
  </div>
</main>

</body>
</html>
