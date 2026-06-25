bor · PHP
<?php
session_start();
include '../config/koneksi.php';
 
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
 
// Statistik dashboard
$jumlah_orangutan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM orangutan"))['total'];
$jumlah_donatur   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM donasi"))['total'];
$total_donasi     = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS total FROM donasi"))['total'] ?? 0;
$donasi_pending   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM donasi WHERE status = 'pending'"))['total'];
 
// 5 donasi terbaru
$donasi_terbaru = mysqli_query($conn, "SELECT * FROM donasi ORDER BY tanggal_donasi DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — OHC Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
 
<div class="admin-container">
 
    <?php include 'sidebar.php'; ?>
 
    <div class="main-content">
 
        <div class="topbar">
            <div>
                <h1>Dashboard</h1>
                <p>Selamat datang kembali, <b><?= htmlspecialchars($_SESSION['admin']); ?></b> 👋</p>
            </div>
        </div>
 
        <!-- Kartu statistik -->
        <div class="dashboard-cards">
            <div class="card">
                <div class="card-icon">🦧</div>
                <h2><?= $jumlah_orangutan; ?></h2>
                <p>Orangutan Dirawat</p>
            </div>
            <div class="card">
                <div class="card-icon">💚</div>
                <h2><?= $jumlah_donatur; ?></h2>
                <p>Total Donatur</p>
            </div>
            <div class="card">
                <div class="card-icon">💰</div>
                <h2>Rp <?= number_format($total_donasi, 0, ',', '.'); ?></h2>
                <p>Total Donasi Terkumpul</p>
            </div>
            <div class="card card-warning">
                <div class="card-icon">⏳</div>
                <h2><?= $donasi_pending; ?></h2>
                <p>Menunggu Konfirmasi</p>
            </div>
        </div>
 
        <!-- Donasi terbaru -->
        <div class="table-section">
            <div class="table-header">
                <h3>Donasi Terbaru</h3>
                <a href="data_donasi.php" class="admin-btn-sm">Lihat Semua</a>
            </div>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nama Donatur</th>
                        <th>Nominal</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($row = mysqli_fetch_assoc($donasi_terbaru)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nama_donatur']); ?></td>
                        <td>Rp <?= number_format($row['nominal'], 0, ',', '.'); ?></td>
                        <td><?= htmlspecialchars($row['metode_pembayaran']); ?></td>
                        <td>
                            <span class="badge-status <?= $row['status']; ?>">
                                <?= ucfirst($row['status']); ?>
                            </span>
                        </td>
                        <td><?= date('d M Y', strtotime($row['tanggal_donasi'])); ?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
 
    </div>
</div>
 
</body>
</html>
 