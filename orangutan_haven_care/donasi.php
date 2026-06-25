
<?php
include 'config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi — Orangutan Haven Care</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
 
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
 
<section class="donasi-section">
    <div class="donasi-wrapper">
 
        <!-- Panel Kiri: Form -->
        <div class="donasi-form-box">
            <span class="section-label">Bantu Mereka</span>
            <h2>Form Donasi</h2>
            <p class="donasi-sub">Setiap donasi kamu sangat berarti bagi perawatan orangutan kami 🦧</p>
 
            <form method="POST" action="donasi_proses.php" enctype="multipart/form-data" id="form-donasi">
 
                <div class="input-group">
                    <label>Nama Donatur *</label>
                    <input type="text" name="nama_donatur" placeholder="Nama lengkap kamu" required>
                </div>
 
                <div class="form-row-2">
                    <div class="input-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="email@contoh.com">
                    </div>
                    <div class="input-group">
                        <label>Nomor HP</label>
                        <input type="text" name="no_hp" placeholder="08xxxxxxxxxx">
                    </div>
                </div>
 
                <!-- Pilihan nominal cepat -->
                <div class="input-group">
                    <label>Nominal Donasi * <small>(min. Rp 10.000)</small></label>
                    <div class="nominal-pills">
                        <button type="button" class="pill" onclick="setNominal(25000)">Rp 25.000</button>
                        <button type="button" class="pill" onclick="setNominal(50000)">Rp 50.000</button>
                        <button type="button" class="pill" onclick="setNominal(100000)">Rp 100.000</button>
                        <button type="button" class="pill" onclick="setNominal(250000)">Rp 250.000</button>
                    </div>
                    <input type="text" name="nominal" id="nominal-input"
                           placeholder="Atau ketik nominal lain"
                           oninput="formatNominal(this)" required>
                </div>
 
                <div class="input-group">
                    <label>Metode Pembayaran *</label>
                    <div class="metode-grid">
                        <label class="metode-card">
                            <input type="radio" name="metode_pembayaran" value="QRIS" onchange="cekMetode('QRIS')" required>
                            <span class="metode-icon">📱</span>
                            <span>QRIS</span>
                        </label>
                        <label class="metode-card">
                            <input type="radio" name="metode_pembayaran" value="Transfer Bank" onchange="cekMetode('Transfer Bank')">
                            <span class="metode-icon">🏦</span>
                            <span>Transfer Bank</span>
                        </label>
                        <label class="metode-card">
                            <input type="radio" name="metode_pembayaran" value="DANA" onchange="cekMetode('DANA')">
                            <span class="metode-icon">💙</span>
                            <span>DANA</span>
                        </label>
                        <label class="metode-card">
                            <input type="radio" name="metode_pembayaran" value="OVO" onchange="cekMetode('OVO')">
                            <span class="metode-icon">💜</span>
                            <span>OVO</span>
                        </label>
                        <label class="metode-card">
                            <input type="radio" name="metode_pembayaran" value="GoPay" onchange="cekMetode('GoPay')">
                            <span class="metode-icon">💚</span>
                            <span>GoPay</span>
                        </label>
                    </div>
                </div>
 
                <!-- Info QRIS -->
                <div id="info-qris" class="info-box" style="display:none;">
                    <div class="qris-box">
                        <p class="qris-label">Scan QR Code di bawah ini</p>
                        <img src="assets/img/qris.jpg" alt="QRIS Orangutan Haven Care" class="qris-img">
                        <p class="qris-note">📌 Setelah transfer, upload bukti pembayaran di bawah</p>
                    </div>
                </div>
 
                <!-- Info Transfer Bank -->
                <div id="info-bank" class="info-box" style="display:none;">
                    <div class="rekening-box">
                        <p><b>Bank BCA</b></p>
                        <p class="no-rek">1234 5678 90</p>
                        <p>a.n. <b>Orangutan Haven Care</b></p>
                    </div>
                    <div class="input-group" style="margin-top:12px;">
                        <label>Nomor Rekening Pengirim</label>
                        <input type="text" name="no_rekening" placeholder="Nomor rekening kamu">
                    </div>
                </div>
 
                <!-- Info E-Wallet -->
                <div id="info-ewallet" class="info-box" style="display:none;">
                    <div class="rekening-box" id="ewallet-detail"></div>
                    <div class="input-group" style="margin-top:12px;">
                        <label>Nomor E-Wallet Pengirim</label>
                        <input type="text" name="no_ewallet" placeholder="Nomor e-wallet kamu">
                    </div>
                </div>
 
                <!-- Upload bukti bayar (muncul semua kecuali QRIS auto-show) -->
                <div id="bukti-upload" class="input-group" style="display:none;">
                    <label>Upload Bukti Pembayaran *</label>
                    <input type="file" name="bukti_bayar" id="bukti-bayar"
                           accept="image/jpeg,image/png,image/webp">
                    <small>Format JPG/PNG, maks. 2MB</small>
                </div>
 
                <div class="input-group">
                    <label>Pesan Dukungan <small>(opsional)</small></label>
                    <textarea name="pesan" rows="3" placeholder="Tuliskan semangat untuk orangutan kami..."></textarea>
                </div>
 
                <button type="submit" class="btn-donasi-submit">💚 Kirim Donasi</button>
 
            </form>
        </div>
 
        <!-- Panel Kanan: Info -->
        <div class="donasi-info-box">
            <h3>Mengapa Donasi Dibutuhkan?</h3>
            <p>Orangutan di Orangutan Haven membutuhkan perawatan jangka panjang. Dana yang terkumpul digunakan untuk:</p>
            <ul class="donasi-list">
                <li>🍌 Makanan harian (buah, sayur, pakan khusus)</li>
                <li>💊 Vitamin dan suplemen kesehatan</li>
                <li>🩺 Pemeriksaan medis rutin</li>
                <li>🌿 Enrichment & aktivitas harian</li>
                <li>🏠 Perawatan kandang & fasilitas</li>
            </ul>
            <div class="donasi-trust">
                <div class="trust-item">
                    <span class="trust-num"><?php
                        $total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS t FROM donasi WHERE status='lunas'"))['t'];
                        echo $total;
                    ?>+</span>
                    <span>Donatur Terpercaya</span>
                </div>
                <div class="trust-item">
                    <span class="trust-num"><?php
                        $nominal = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS t FROM donasi WHERE status='lunas'"))['t'] ?? 0;
                        echo 'Rp ' . number_format($nominal, 0, ',', '.');
                    ?></span>
                    <span>Dana Terkumpul</span>
                </div>
            </div>
        </div>
 
    </div>
</section>
 
<footer class="footer">
    <div class="footer-content">
        <h3>Orangutan Haven Care</h3>
        <p>Website donasi dan edukasi untuk mendukung perawatan orangutan yang tidak dapat kembali ke alam liar.</p>
        <div class="footer-links">
            <a href="index.php">Home</a>
            <a href="index.php#tentang">Tentang</a>
            <a href="index.php#orangutan">Orangutan</a>
        </div>
        <span>© 2026 Orangutan Haven Care. All Rights Reserved.</span>
    </div>
</footer>
 
<script>
const ewalletInfo = {
    'DANA':  { icon: '💙', nama: 'DANA', nomor: '0812-3456-7890', an: 'Orangutan Haven Care' },
    'OVO':   { icon: '💜', nama: 'OVO',  nomor: '0812-3456-7890', an: 'Orangutan Haven Care' },
    'GoPay': { icon: '💚', nama: 'GoPay',nomor: '0812-3456-7890', an: 'Orangutan Haven Care' },
};
 
function cekMetode(nilai) {
    document.getElementById('info-qris').style.display    = 'none';
    document.getElementById('info-bank').style.display    = 'none';
    document.getElementById('info-ewallet').style.display = 'none';
    document.getElementById('bukti-upload').style.display = 'none';
 
    if(nilai === 'QRIS'){
        document.getElementById('info-qris').style.display   = 'block';
        document.getElementById('bukti-upload').style.display = 'block';
    } else if(nilai === 'Transfer Bank'){
        document.getElementById('info-bank').style.display   = 'block';
        document.getElementById('bukti-upload').style.display = 'block';
    } else if(ewalletInfo[nilai]){
        const e = ewalletInfo[nilai];
        document.getElementById('ewallet-detail').innerHTML =
            `<p><b>${e.icon} ${e.nama}</b></p><p class="no-rek">${e.nomor}</p><p>a.n. <b>${e.an}</b></p>`;
        document.getElementById('info-ewallet').style.display = 'block';
        document.getElementById('bukti-upload').style.display = 'block';
    }
 
    // Highlight kartu metode aktif
    document.querySelectorAll('.metode-card').forEach(c => c.classList.remove('active'));
    const radio = document.querySelector(`input[value="${nilai}"]`);
    if(radio) radio.closest('.metode-card').classList.add('active');
}
 
function setNominal(val) {
    document.getElementById('nominal-input').value = 'Rp ' + val.toLocaleString('id-ID');
    document.querySelectorAll('.pill').forEach(p => p.classList.remove('active'));
    event.target.classList.add('active');
}
 
function formatNominal(el) {
    let raw = el.value.replace(/[^0-9]/g, '');
    if(raw) el.value = 'Rp ' + parseInt(raw).toLocaleString('id-ID');
    document.querySelectorAll('.pill').forEach(p => p.classList.remove('active'));
}
 
// Validasi form sebelum submit
document.getElementById('form-donasi').addEventListener('submit', function(e){
    const nominal = document.getElementById('nominal-input').value.replace(/[^0-9]/g, '');
    if(parseInt(nominal) < 10000){
        e.preventDefault();
        alert('Minimal donasi adalah Rp 10.000');
        return;
    }
    const metode = document.querySelector('input[name="metode_pembayaran"]:checked');
    if(!metode){
        e.preventDefault();
        alert('Pilih metode pembayaran terlebih dahulu');
    }
});
</script>
 
</body>
</html>
 