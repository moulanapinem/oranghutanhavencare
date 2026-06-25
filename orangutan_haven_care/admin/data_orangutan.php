<?php
session_start();
include '../config/koneksi.php';
 
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
 
$data = mysqli_query($conn, "SELECT * FROM orangutan ORDER BY id_orangutan DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Orangutan — OHC Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
 
<div class="admin-container">
    <?php include 'sidebar.php'; ?>
 
    <div class="main-content">
 
        <div class="topbar">
            <h1>Data Orangutan</h1>
            <a href="tambah_orangutan.php" class="admin-btn">+ Tambah Orangutan</a>
        </div>
 
        <?php if(isset($_GET['msg']) && $_GET['msg'] === 'hapus'): ?>
        <div class="alert-success">✅ Data orangutan berhasil dihapus.</div>
        <?php endif; ?>
 
        <table class="admin-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Jenis Kelamin</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1; while($row = mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td>
                        <?php if(!empty($row['foto']) && file_exists("../uploads/".$row['foto'])): ?>
                            <img src="../uploads/<?= htmlspecialchars($row['foto']); ?>"
                                 width="70" height="70"
                                 style="object-fit:cover; border-radius:10px;">
                        <?php else: ?>
                            <div class="no-img">🦧</div>
                        <?php endif; ?>
                    </td>
                    <td><b><?= htmlspecialchars($row['nama']); ?></b></td>
                    <td><?= (int)$row['umur']; ?> tahun</td>
                    <td><?= htmlspecialchars($row['jenis_kelamin']); ?></td>
                    <td><span class="badge-status lunas"><?= htmlspecialchars($row['status']); ?></span></td>
                    <td>
                        <a href="edit_orangutan.php?id=<?= (int)$row['id_orangutan']; ?>" class="btn-edit">✏️ Edit</a>
                        <a href="hapus_orangutan.php?id=<?= (int)$row['id_orangutan']; ?>"
                           onclick="return confirm('Yakin ingin menghapus <?= htmlspecialchars(addslashes($row['nama'])); ?>?')"
                           class="btn-hapus">🗑️ Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
 
    </div>
</div>
 
</body>
</html>
 