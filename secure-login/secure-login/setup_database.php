<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi langsung ke MySQL tanpa database
try {
    $conn = new PDO("mysql:host=localhost", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Buat database jika belum ada
    $conn->exec("CREATE DATABASE IF NOT EXISTS secure_login");
    echo "Database secure_login berhasil dibuat<br>";
    
    // Pilih database
    $conn->exec("USE secure_login");
    
    // Hapus tabel users jika sudah ada
    $conn->exec("DROP TABLE IF EXISTS users");
    
    // Buat tabel users
    $sql = "CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $conn->exec($sql);
    echo "Tabel users berhasil dibuat<br>";
    
    // Masukkan user test
    $email = "test@example.com";
    $password = "Test123456";
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->execute([$email, $hashed_password]);
    
    echo "<div style='background-color: #dff0d8; padding: 15px; margin: 10px 0; border-radius: 4px;'>";
    echo "<h3 style='color: #3c763d;'>Setup Database Berhasil!</h3>";
    echo "<p><strong>User test berhasil dibuat:</strong><br>";
    echo "Email: test@example.com<br>";
    echo "Password: Test123456</p>";
    echo "<p>Anda sekarang bisa mencoba login di <a href='index.php'>halaman login</a></p>";
    echo "</div>";
    
} catch(PDOException $e) {
    echo "<div style='background-color: #f2dede; padding: 15px; margin: 10px 0; border-radius: 4px;'>";
    echo "<h3 style='color: #a94442;'>Error!</h3>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
    echo "</div>";
}

$conn = null;
?>