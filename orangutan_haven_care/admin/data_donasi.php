
<?php
session_start();
include '../config/koneksi.php';
 
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
 
// Konfirmasi donasi
if(isset($_GET['konfirmasi'])){
    $id = (int)$_GET['konfirmasi'];
    $stmt = mysqli_prepare($conn, "UPDATE donasi SET status = 'lunas' WHERE id_donasi = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: data_donasi.php?msg=konfirmasi");
    exit;
}
 
// Tolak donasi
if(isset($_GET['tolak'])){
    $id = (int)$_GET['tolak'];
    $stmt = mysqli_prepare($conn, "UPDATE donasi SET status = 'ditolak' WHERE id_donasi = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: data_donasi.php?msg=tolak");
    exit;
}
 
// Filter status
$filter = $_GET['status'] ?? 'semua';
$where  = '';
if($filter === 'pending')  $where = "WHERE status = 'pending'";
if($filter === 'lunas')    $where = "WHERE status = 'lunas'";
if($filter === 'ditolak')  $where = "WHERE status = 'ditolak'";
 
$data_donasi = mysqli_query($conn, "SELECT * FROM donasi $where ORDER BY tanggal_donasi DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Donasi — OHC Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
 
<div class="admin-container">
    <?php include 'sidebar.php'; ?>
 
    <div class="main-content">
 
        <div class="topbar">
            <h1>Data Donasi</h1>
        </div>
 
        <?php if(isset($_GET['msg'])): ?>
        <div class="alert-success">
            <?= $_GET['msg'] === 'konfirmasi' ? '✅ Donasi berhasil dikonfirmasi.' : '❌ Donasi ditolak.'; ?>
        </div>
        <?php endif; ?>
 
        <!-- Filter tab -->
        <div class="filter-tabs">
            <a href="?status=semua"   class="<?= $filter === 'semua'   ? 'active' : ''; ?>">Semua</a>
            <a href="?status=pending" class="<?= $filter === 'pending' ? 'active' : ''; ?>">⏳ Pending</a>
            <a href="?status=lunas"   class="<?= $filter === 'lunas'   ? 'active' : ''; ?>">✅ Lunas</a>
            <a href="?status=ditolak" class="<?= $filter === 'ditolak' ? 'active' : ''; ?>">❌ Ditolak</a>
        </div>
 
        <table class="admin-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email / No HP</th>
                    <th>Nominal</th>
                    <th>Metode</th>
                    <th>Bukti</th>
                    <th>Pesan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1; while($row = mysqli_fetch_assoc($data_donasi)): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nama_donatur']); ?></td>
                    <td>
                        <?= htmlspecialchars($row['email']); ?><br>
                        <small><?= htmlspecialchars($row['no_hp']); ?></small>
                    </td>
                    <td><b>Rp <?= number_format($row['nominal'], 0, ',', '.'); ?></b></td>
                    <td><?= htmlspecialchars($row['metode_pembayaran']); ?></td>
                    <td>
                        <?php if(!empty($row['bukti_bayar'])): ?>
                            <a href="../uploads/bukti/<?= htmlspecialchars($row['bukti_bayar']); ?>" target="_blank" class="btn-lihat">Lihat</a>
                        <?php else: ?>
                            <span style="color:#aaa">—</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['pesan']); ?></td>
                    <td><?= date('d M Y', strtotime($row['tanggal_donasi'])); ?></td>
                    <td>
                        <span class="badge-status <?= $row['status']; ?>">
                            <?= ucfirst($row['status']); ?>
                        </span>
                    </td>
                    <td>
                        <?php if($row['status'] === 'pending'): ?>
                            <a href="?konfirmasi=<?= $row['id_donasi']; ?>"
                               onclick="return confirm('Konfirmasi donasi ini?')"
                               class="btn-konfirmasi">✅</a>
                            <a href="?tolak=<?= $row['id_donasi']; ?>"
                               onclick="return confirm('Tolak donasi ini?')"
                               class="btn-tolak">❌</a>
                        <?php else: ?>
                            <span style="color:#aaa">—</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
 
    </div>
</div>
 
</body>
</html>
 