<?php
session_start();
include '../config/koneksi.php';
 
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
 
$error = '';
 
if(isset($_POST['submit'])){
    $nama          = trim($_POST['nama']);
    $umur          = (int)$_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $status        = trim($_POST['status']);
    $kondisi       = trim($_POST['kondisi']);
    $cerita        = trim($_POST['cerita']);
 
    if(empty($nama)){
        $error = 'Nama orangutan wajib diisi.';
    } elseif(!in_array($jenis_kelamin, ['Jantan', 'Betina'])){
        $error = 'Jenis kelamin tidak valid.';
    } elseif(empty($_FILES['foto']['name'])){
        $error = 'Foto wajib diunggah.';
    } else {
        $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
        $file_type     = mime_content_type($_FILES['foto']['tmp_name']);
        $file_size     = $_FILES['foto']['size'];
 
        if(!in_array($file_type, $allowed_types)){
            $error = 'Format foto harus JPG, PNG, atau WebP.';
        } elseif($file_size > 2 * 1024 * 1024){
            $error = 'Ukuran foto maksimal 2MB.';
        } else {
            $ext  = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $foto = uniqid('orang_') . '.' . strtolower($ext);
            move_uploaded_file($_FILES['foto']['tmp_name'], "../uploads/" . $foto);
 
            $stmt = mysqli_prepare($conn,
                "INSERT INTO orangutan (nama, umur, jenis_kelamin, status, kondisi, cerita, foto) VALUES (?, ?, ?, ?, ?, ?, ?)"
            );
            mysqli_stmt_bind_param($stmt, "sisssss", $nama, $umur, $jenis_kelamin, $status, $kondisi, $cerita, $foto);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
 
            header("Location: data_orangutan.php?msg=tambah");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Orangutan — OHC Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="admin-container">
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <div class="topbar">
            <h1>Tambah Orangutan</h1>
            <a href="data_orangutan.php" class="admin-btn-sm">← Kembali</a>
        </div>
        <?php if($error): ?>
            <div class="alert-error"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <div class="form-card">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="input-group">
                        <label>Nama Orangutan *</label>
                        <input type="text" name="nama" placeholder="Contoh: Budi" required>
                    </div>
                    <div class="input-group">
                        <label>Umur (tahun)</label>
                        <input type="number" name="umur" min="0" max="60" placeholder="0">
                    </div>
                    <div class="input-group">
                        <label>Jenis Kelamin *</label>
                        <select name="jenis_kelamin" required>
                            <option value="">Pilih</option>
                            <option value="Jantan">Jantan</option>
                            <option value="Betina">Betina</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label>Status</label>
                        <input type="text" name="status" placeholder="Contoh: Dalam Perawatan">
                    </div>
                </div>
                <div class="input-group">
                    <label>Kondisi Kesehatan</label>
                    <textarea name="kondisi" rows="3" placeholder="Jelaskan kondisi orangutan saat ini..."></textarea>
                </div>
                <div class="input-group">
                    <label>Cerita / Latar Belakang</label>
                    <textarea name="cerita" rows="5" placeholder="Ceritakan latar belakang orangutan ini..."></textarea>
                </div>
                <div class="input-group">
                    <label>Foto * <small>(JPG/PNG/WebP, maks. 2MB)</small></label>
                    <input type="file" name="foto" accept="image/jpeg,image/png,image/webp" required>
                </div>
                <div class="form-actions">
                    <button type="submit" name="submit" class="btn-save">💾 Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
 