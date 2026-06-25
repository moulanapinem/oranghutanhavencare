<?php
// ============================================================
// FILE INI HANYA DIJALANKAN SEKALI untuk membuat akun admin
// Setelah berhasil, HAPUS file ini dari server!
// ============================================================
include 'config/koneksi.php';
 
$username = 'admin';
$password = 'admin123'; // Ganti password sesuai keinginan
 
$hash = password_hash($password, PASSWORD_DEFAULT);
 
$stmt = mysqli_prepare($conn, "INSERT INTO admin (username, password) VALUES (?, ?) ON DUPLICATE KEY UPDATE password = ?");
mysqli_stmt_bind_param($stmt, "sss", $username, $hash, $hash);
 
if(mysqli_stmt_execute($stmt)){
    echo "<h2 style='color:green'>✅ Admin berhasil dibuat!</h2>";
    echo "<p>Username: <b>$username</b></p>";
    echo "<p>Password: <b>$password</b></p>";
    echo "<hr><p style='color:red'><b>⚠️ HAPUS FILE INI SEKARANG dari server!</b></p>";
    echo "<p><a href='admin/login.php'>→ Pergi ke halaman login</a></p>";
} else {
    echo "❌ Gagal: " . mysqli_error($conn);
}
?>