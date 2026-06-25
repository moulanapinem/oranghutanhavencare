<?php
// 1. Menghubungkan ke konfigurasi database
include 'config/koneksi.php';

// 2. Mengambil 3 data orangutan terbaru untuk ditampilkan di beranda
$data_orangutan = mysqli_query($conn, "SELECT * FROM orangutan ORDER BY id_orangutan DESC LIMIT 7");
$total_orangutan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orangutan"));
$total_donatur = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM donasi"));
$total_donasi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS total FROM donasi"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orangutan Haven Care - Beranda</title>
    <!-- Menghubungkan ke berkas CSS utama -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
   <div id="loader">
    <div class="loader-content">
        <h2>Orangutan Haven Care</h2>
        <p>Loading...</p>
    </div>
</div>
    <!-- Bagian Menu Navigasi atas (Navbar) -->
    <nav class="navbar">
        <div class="logo">
            Orangutan Haven Care
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="#tentang">Tentang</a></li>
            <li><a href="#orangutan">Orangutan</a></li>
            <li><a href="#edukasi">Edukasi</a></li>
            <li><a href="#laporan">Laporan</a></li>
        </ul>
        <!-- Perbaikan: Link diarahkan langsung ke halaman formulir donasi -->
        <a href="donasi.php" class="donasi-btn">Donasi Sekarang</a>
    </nav>

    <!-- Bagian Hero Section (Tampilan Muka) -->
    <section class="hero">
        <h1>Orangutan Haven Care</h1>
        <p>
            Bantu Perawatan Orangutan yang Tidak Dapat Kembali ke Alam Liar
        </p>
        <!-- Perbaikan: Tombol diubah langsung mengarah ke halaman donasi -->
        <a href="donasi.php" class="hero-btn">Donasi Sekarang</a>
    </section>

    <!-- Bagian Latar Belakang Masalah (Tentang) -->
    <section class="problem-section" id="tentang">
        <div class="problem-container">
            <span class="section-label">Mengapa Donasi Dibutuhkan?</span>
            <h2>Mereka Tidak Selalu Bisa Kembali ke Alam Liar</h2>
            <p>
                Beberapa orangutan membutuhkan perawatan jangka panjang karena kondisi kesehatan,
                trauma, cacat fisik, atau konflik dengan manusia. Melalui donasi, kita dapat
                membantu kebutuhan makanan, vitamin, pemeriksaan kesehatan, dan perawatan mereka.
            </p>
        </div>
    </section>

    <!-- Bagian Menampilkan Profil Singkat Orangutan -->
    <section class="orangutan-section" id="orangutan">
        <div class="section-title">
            <span>Orangutan Kami</span>
            <h2>Beberapa Orangutan di Orangutan Haven</h2>
        </div>
        
        <div class="orangutan-container">
            <?php 
            // Memeriksa dan mengulang baris data orangutan yang ada di database
            if ($data_orangutan && mysqli_num_rows($data_orangutan) > 0) {
                while($row = mysqli_fetch_assoc($data_orangutan)){ 
                ?>
                <div class="orangutan-card">
                    <!-- Deteksi berkas gambar -->
                    <?php if (!empty($row['foto']) && file_exists("uploads/" . $row['foto'])): ?>
                        <img src="uploads/<?= htmlspecialchars($row['foto']); ?>" alt="<?= htmlspecialchars($row['nama']); ?>">
                    <?php else: ?>
                        <div style="background: #e2e8f0; width: 100%; height: 200px; display: flex; align-items: center; justify-content: center; color: #64748b;">No Image</div>
                    <?php endif; ?>
                    
                    <div class="orangutan-content">
                        <h3><?= htmlspecialchars($row['nama']); ?></h3>
                        <!-- Pemotongan kalimat cerita agar muat di dalam ukuran kartu komparasi -->
                        <p><?= htmlspecialchars(substr($row['cerita'], 0, 120)); ?>...</p>
                        <a href="detail_orangutan.php?id=<?= $row['id_orangutan']; ?>">Lihat Detail</a>
                    </div>
                </div>
                <?php 
                } 
            } else { ?>
                <p style="grid-column: 1/-1; text-align: center; color: #666;">Belum ada data orangutan untuk ditampilkan.</p>
            <?php } ?>
        </div>
    </section>

    <!-- Bagian Materi Edukasi Publik -->
    <section class="education-section" id="edukasi">
        <div class="section-title">
            <span>Edukasi Konservasi</span>
            <h2>Mengapa Orangutan Perlu Dilindungi?</h2>
        </div>
        <div class="edu-wrapper">
            <div class="edu-box">
                <h3>Habitat Terancam</h3>
                <p>
                    Orangutan membutuhkan hutan sebagai tempat hidup, mencari makan, dan membangun sarang.
                </p>
            </div>
            <div class="edu-box">
                <h3>Tidak Semua Bisa Dilepasliarkan</h3>
                <p>
                    Beberapa orangutan membutuhkan perawatan jangka panjang karena kondisi fisik, trauma, atau konflik dengan manusia.
                </p>
            </div>
            <div class="edu-box">
                <h3>Perawatan Berkelanjutan</h3>
                <p>
                    Dukungan masyarakat membantu kebutuhan makanan, kesehatan, enrichment, dan pemantauan harian orangutan.
                </p>
            </div>
        </div>
    </section>

    <!-- Bagian Rincian Penyaluran Alokasi Dana -->
    <section class="impact-section">
        <div class="impact-container">
            <div class="impact-text">
                <span>Dampak Donasi</span>
                <h2>Setiap Bantuan Membantu Perawatan Mereka</h2>
                <p>
                    Donasi yang terkumpul digunakan untuk mendukung kebutuhan makanan,
                    vitamin, pemeriksaan kesehatan, enrichment, serta perawatan harian
                    orangutan di Orangutan Haven.
                </p>
            </div>                  
            <div class="impact-grid">
                <div class="impact-box">
                    <h3>Makanan</h3>
                    <p>Membantu kebutuhan buah, daun muda, dan pakan harian.</p>
                </div>
                <div class="impact-box">
                    <h3>Kesehatan</h3>
                    <p>Mendukung pemeriksaan kesehatan, vitamin, dan pemantauan rutin.</p>
                </div>
                <div class="impact-box">
                    <h3>Perawatan</h3>
                    <p>Membantu kebutuhan enrichment dan perawatan jangka panjang.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian Baris Data Statistik (Laporan) -->
    <section class="stats-section" id="laporan">
    <div class="stats-container">
        <div class="stat-box">
            <h2><?= $total_orangutan; ?>+</h2>
            <p>Orangutan Dirawat</p>
        </div>
        <div class="stat-box">
            <h2><?= $total_donatur; ?>+</h2>
            <p>Donatur</p>
        </div>
        <div class="stat-box">
            <h2>Rp <?= number_format($total_donasi['total'] ?? 0, 0, ',', '.'); ?></h2>
            <p>Total Donasi</p>
        </div>
    </div>
   </section>
    <!-- Bagian Footer (Catatan Kaki Website) -->
    <footer class="footer">
        <div class="footer-content">
            <h3>Orangutan Haven Care</h3>
            <p>
                Website donasi dan edukasi untuk mendukung perawatan orangutan yang tidak dapat kembali ke alam liar.
            </p>
            <div class="footer-links">
                <a href="index.php">Home</a>
                <a href="#tentang">Tentang</a>
                <a href="#orangutan">Orangutan</a>
                <a href="#edukasi">Edukasi</a>
                <a href="#laporan">Laporan</a>
            </div>
            <span>© 2026 Orangutan Haven Care. All Rights Reserved.</span>
        </div>
    </footer>
    <!-- Perbaikan: Menghapus </div> sisa di baris paling bawah yang berlebih -->
   <script src="assets/js/script.js"></script>
   
</body>
</html>
