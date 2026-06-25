<?php
include 'config/koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($conn, "SELECT * FROM orangutan WHERE id_orangutan='$id'");
$row = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($row['nama']); ?> - Orangutan Haven Care</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="logo">Orangutan Haven Care</div>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php#tentang">Tentang</a></li>
        <li><a href="index.php#orangutan">Orangutan</a></li>
        <li><a href="index.php#edukasi">Edukasi</a></li>
        <li><a href="index.php#laporan">Laporan</a></li>
    </ul>
    <a href="index.php" class="donasi-btn">← Kembali</a>
</nav>

<!-- Detail Orangutan -->
<section class="detail-section">
    <div class="detail-container">

        <div class="detail-image-box">
            <img src="uploads/<?= htmlspecialchars($row['foto']); ?>"
                 alt="<?= htmlspecialchars($row['nama']); ?>">
        </div>

        <div class="detail-content">

            <span class="badge-title">Profil Orangutan</span>

            <h1><?= htmlspecialchars($row['nama']); ?></h1>

            <div class="info-meta">
                <p><b>Umur:</b> <?= $row['umur']; ?> tahun</p>
                <p><b>Jenis Kelamin:</b> <?= htmlspecialchars($row['jenis_kelamin']); ?></p>
                <p><b>Status:</b> <?= htmlspecialchars($row['status']); ?></p>
            </div>

            <h3>Kondisi</h3>
            <p class="description-text">
                <?= htmlspecialchars($row['kondisi']); ?>
            </p>

            <h3>Cerita</h3>
            <p class="description-text">
                <?= nl2br(htmlspecialchars($row['cerita'])); ?>
            </p>

            <a href="donasi.php" class="donasi-btn">
                💚 Donasi untuk <?= htmlspecialchars($row['nama']); ?>
            </a>

        </div>

    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="footer-content">
        <h3>Orangutan Haven Care</h3>
        <p>Website donasi dan edukasi untuk mendukung perawatan orangutan yang tidak dapat kembali ke alam liar.</p>
        <div class="footer-links">
            <a href="index.php">Home</a>
            <a href="index.php#tentang">Tentang</a>
            <a href="index.php#orangutan">Orangutan</a>
            <a href="index.php#edukasi">Edukasi</a>
            <a href="index.php#laporan">Laporan</a>
        </div>
        <span>© 2026 Orangutan Haven Care. All Rights Reserved.</span>
    </div>
</footer>

</body>
</html>
