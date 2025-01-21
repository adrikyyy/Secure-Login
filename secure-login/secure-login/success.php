<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h3>Login Berhasil!</h3>
            </div>
            <div class="card-body">
                <p>Selamat datang di sistem.</p>
                <a href="process_login.php?logout=true" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>