<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // LOGIN
    if (isset($_POST['login'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                $stmt->close();
                $conn->close();
                header("Location: home.php");
                exit;
            } else {
                $_SESSION['error'] = "Invalid credentials.";
            }
        } else {
            $_SESSION['error'] = "User not found.";
        }
        $stmt->close();
        $conn->close();
        header("Location: login.php");
        exit;
    }

    // REGISTER
    if (isset($_POST['register'])) {
        $fullname = trim($_POST['fullname']);
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);

        if ($password !== $confirm_password) {
            $_SESSION['error'] = "Passwords do not match.";
            header("Location: register.php");
            exit;
        }

        // Check if username or email exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $_SESSION['error'] = "Username or email already taken.";
            $stmt->close();
            $conn->close();
            header("Location: register.php");
            exit;
        }
        $stmt->close();

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (fullname, username, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fullname, $username, $email, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Registration successful! You may now log in.";
            $stmt->close();
            $conn->close();
            header("Location: login.php");
            exit;
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again.";
            $stmt->close();
            $conn->close();
            header("Location: register.php");
            exit;
        }
    }
    // Fallback
    header("Location: login.php");
    exit;
}
