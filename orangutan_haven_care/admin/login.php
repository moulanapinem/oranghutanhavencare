<?php
session_start();
include '../config/koneksi.php';
 
// Kalau sudah login, langsung ke dashboard
if(isset($_SESSION['admin'])){
    header("Location: dashboard.php");
    exit;
}
 
$error = '';
 
if(isset($_POST['login'])){
    $username = trim($_POST['username']);
    $password = $_POST['password'];
 
    if(empty($username) || empty($password)){
        $error = 'Username dan password wajib diisi.';
    } else {
        // Prepared statement — aman dari SQL Injection
        $stmt = mysqli_prepare($conn, "SELECT * FROM admin WHERE username = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $admin  = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
 
        // Verifikasi password dengan password_verify (password harus di-hash dulu di DB)
       if($admin && $admin['password'] === $password){
            session_regenerate_id(true);
            $_SESSION['admin']    = $admin['username'];
            $_SESSION['admin_id'] = $admin['id'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = 'Username atau password salah.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — Orangutan Haven Care</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
 
<div class="login-container">
    <form method="POST" class="login-form">
 
        <div class="login-logo">🦧</div>
        <h2>OHC Admin</h2>
        <p class="login-sub">Orangutan Haven Care</p>
 
        <?php if($error): ?>
            <div class="alert-error"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>
 
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username"
                   placeholder="Masukkan username"
                   value="<?= htmlspecialchars($_POST['username'] ?? ''); ?>"
                   required autocomplete="username">
        </div>
 
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password"
                   placeholder="Masukkan password"
                   required autocomplete="current-password">
        </div>
 
        <button type="submit" name="login" class="btn-login">Masuk</button>
 
    </form>
</div>
 
</body>
</html>