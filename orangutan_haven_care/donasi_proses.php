
<?php
include 'config/koneksi.php';
 
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header("Location: donasi.php");
    exit;
}
 
// Bersihkan nominal
$nominal = (int)preg_replace('/[^0-9]/', '', $_POST['nominal'] ?? '0');
 
if($nominal < 10000){
    echo "<script>alert('Minimal donasi Rp 10.000!'); history.back();</script>";
    exit;
}
 
$nama_donatur      = trim($_POST['nama_donatur'] ?? '');
$email             = trim($_POST['email'] ?? '');
$no_hp             = trim($_POST['no_hp'] ?? '');
$metode_pembayaran = $_POST['metode_pembayaran'] ?? '';
$pesan             = trim($_POST['pesan'] ?? '');
$no_ewallet        = trim($_POST['no_ewallet'] ?? '');
$no_rekening       = trim($_POST['no_rekening'] ?? '');
 
// Upload bukti bayar
$bukti_bayar = '';
if(!empty($_FILES['bukti_bayar']['name'])){
    $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
    $file_type     = mime_content_type($_FILES['bukti_bayar']['tmp_name']);
    $file_size     = $_FILES['bukti_bayar']['size'];
 
    if(!in_array($file_type, $allowed_types)){
        echo "<script>alert('Format bukti harus JPG, PNG, atau WebP!'); history.back();</script>";
        exit;
    }
    if($file_size > 2 * 1024 * 1024){
        echo "<script>alert('Ukuran bukti maksimal 2MB!'); history.back();</script>";
        exit;
    }
 
    if(!is_dir('uploads/bukti')) mkdir('uploads/bukti', 0755, true);
 
    $ext         = pathinfo($_FILES['bukti_bayar']['name'], PATHINFO_EXTENSION);
    $bukti_bayar = uniqid('bukti_') . '.' . strtolower($ext);
    move_uploaded_file($_FILES['bukti_bayar']['tmp_name'], "uploads/bukti/" . $bukti_bayar);
}
 
// Simpan ke database dengan prepared statement
$stmt = mysqli_prepare($conn,
    "INSERT INTO donasi (nama_donatur, email, no_hp, no_ewallet, no_rekening, nominal, metode_pembayaran, pesan, bukti_bayar, status, tanggal_donasi)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', CURRENT_TIMESTAMP)"
);
mysqli_stmt_bind_param($stmt, "sssssisss",
    $nama_donatur, $email, $no_hp, $no_ewallet, $no_rekening,
    $nominal, $metode_pembayaran, $pesan, $bukti_bayar
);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
 
header("Location: donasi_sukses.php");
exit;
 