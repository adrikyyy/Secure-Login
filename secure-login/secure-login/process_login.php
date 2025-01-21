<?php
session_start();
require_once 'config/database.php';
require_once 'utils/InputValidator.php';

// Handle logout
if(isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_POST['email']) || !isset($_POST['password'])) {
            throw new Exception("Email dan password harus diisi");
        }

        $email = InputValidator::sanitizeInput($_POST['email']);
        $password = $_POST['password'];
        
        // Debug info
        error_log("Login attempt - Email: " . $email);
        
        if (!InputValidator::validateEmail($email)) {
            throw new Exception("Format email tidak valid");
        }

        // Connect to database
        $database = new Database();
        $db = $database->getConnection();
        
        // Check user credentials
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Debug info
        error_log("User found: " . ($user ? "Yes" : "No"));
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['success'] = "Login berhasil!";
            error_log("Login successful for user: " . $user['id']);
            header("Location: success.php");
            exit();
        } else {
            error_log("Login failed for email: " . $email);
            throw new Exception("Email atau password salah");
        }
        
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: index.php");
        exit();
    }
}

// Redirect if accessed directly
header("Location: index.php");
exit();
?>