<?php
require 'db.php';
session_start();

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['register'])) {
    $fullname = trim($_POST['fullname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        if ($check_stmt === false) {
            die("Prepare failed: " . $conn->error);
        }
        $check_stmt->bind_param("s", $username);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $_SESSION['error'] = "Username already taken. Please choose another.";
        } else {
            $stmt = $conn->prepare("INSERT INTO users (fullname, username, email, password) VALUES (?, ?, ?, ?)");
            if ($stmt === false) {
                die("Prepare failed: " . $conn->error);
            }
            $stmt->bind_param("ssss", $fullname, $username, $email, $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Registration successful! You may now log in.";
                header("Location: login.php");
                exit();
            } else {
                $_SESSION['error'] = "Registration failed: " . $stmt->error;
            }
        }
        $check_stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register - CHN atelier</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f8f8fa;
    }

    .login-page {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: linear-gradient(to bottom, #f49378 0%, #f8f8fa 100%);
      padding: 2rem;
    }

    .auth-container {
      background: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
    }

    .auth-container h2 {
      color: #c4287e;
      margin-bottom: 1.5rem;
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
      margin: 0.4rem 0;
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
      margin-top: 1.5rem;
    }

    .form-switch button {
      background: transparent;
      border: 1px solid #e89ab5;
      color: #e89ab5;
      padding: 0.5rem 1rem;
      border-radius: 5px;
      cursor: pointer;
    }

    .form-switch button:hover {
      background: #e89ab5;
      color: white;
    }

    @media (max-width: 768px) {
      .auth-container {
        padding: 1.5rem;
      }

      .auth-form input,
      .auth-form button {
        font-size: 0.95rem;
      }

      .social-btn {
        font-size: 0.95rem;
      }
    }

    @media (max-width: 480px) {
      .auth-form input,
      .auth-form button {
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
  <div class="auth-container">
    <h2>Join CHN Atelier</h2>

    <?php
    if (isset($_SESSION['error'])) {
      echo '<div class="auth-alert error">' . htmlspecialchars($_SESSION['error']) . '</div>';
      unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
      echo '<div class="auth-alert success">' . htmlspecialchars($_SESSION['success']) . '</div>';
      unset($_SESSION['success']);
    }
    ?>

    <form class="auth-form" action="register.php" method="POST">
      <input type="text" name="fullname" placeholder="Full Name" required>
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required minlength="6">
      <input type="password" name="confirm_password" placeholder="Confirm Password" required minlength="6">
      <button type="submit" name="register">Register</button>

      <div class="social-login">
        <p>Or sign up with:</p>
        <button type="button" class="social-btn google-btn"
          onclick="window.location.href='https://accounts.google.com/o/oauth2/v2/auth?client_id=YOUR_CLIENT_ID&redirect_uri=YOUR_REDIRECT_URI&response_type=code&scope=email%20profile'">
          <i class="fab fa-google" style="color: red;"></i> Google
        </button>
        <button type="button" class="social-btn facebook-btn"
          onclick="window.location.href='https://www.facebook.com/v19.0/dialog/oauth?client_id=YOUR_APP_ID&redirect_uri=YOUR_REDIRECT_URI&scope=email'">
          <i class="fab fa-facebook-f"></i> Facebook
        </button>
      </div>
    </form>

    <div class="form-switch">
      <p>Already have an account?</p>
      <button onclick="window.location.href='login.php'">Login</button>
    </div>
  </div>
</main>
</body>
</html>
