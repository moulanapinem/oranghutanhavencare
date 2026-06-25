<?php
session_start();
include '../config/koneksi.php';
 
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
 
$id = (int)($_GET['id'] ?? 0);
if($id <= 0){ header("Location: data_orangutan.php"); exit; }
 
$stmt = mysqli_prepare($conn, "SELECT * FROM orangutan WHERE id_orangutan = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);
 
if(!$row){ header("Location: data_orangutan.php"); exit; }
 
$error = '';
 
if(isset($_POST['submit'])){
    $nama          = trim($_POST['nama']);
    $umur          = (int)$_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $status        = trim($_POST['status']);
    $kondisi       = trim($_POST['kondisi']);
    $cerita        = trim($_POST['cerita']);
    $foto          = $row['foto'];
 
    if(!in_array($jenis_kelamin, ['Jantan', 'Betina'])){
        $error = 'Jenis kelamin tidak valid.';
    } elseif(!empty($_FILES['foto']['name'])){
        $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
        $file_type     = mime_content_type($_FILES['foto']['tmp_name']);
        $file_size     = $_FILES['foto']['size'];
 
        if(!in_array($file_type, $allowed_types)){
            $error = 'Format foto harus JPG, PNG, atau WebP.';
        } elseif($file_size > 2 * 1024 * 1024){
            $error = 'Ukuran foto maksimal 2MB.';
        } else {
            // Hapus foto lama
            if(!empty($row['foto']) && file_exists("../uploads/".$row['foto'])){
                unlink("../uploads/".$row['foto']);
            }
            $ext  = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $foto = uniqid('orang_') . '.' . strtolower($ext);
            move_uploaded_file($_FILES['foto']['tmp_name'], "../uploads/" . $foto);
        }
    }
 
    if(empty($error)){
        $stmt = mysqli_prepare($conn,
            "UPDATE orangutan SET nama=?, umur=?, jenis_kelamin=?, status=?, kondisi=?, cerita=?, foto=? WHERE id_orangutan=?"
        );
        mysqli_stmt_bind_param($stmt, "sisssssi", $nama, $umur, $jenis_kelamin, $status, $kondisi, $cerita, $foto, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: data_orangutan.php?msg=edit");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Orangutan — OHC Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="admin-container">
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <div class="topbar">
            <h1>Edit Orangutan</h1>
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
                        <input type="text" name="nama" value="<?= htmlspecialchars($row['nama']); ?>" required>
                    </div>
                    <div class="input-group">
                        <label>Umur (tahun)</label>
                        <input type="number" name="umur" min="0" max="60" value="<?= (int)$row['umur']; ?>">
                    </div>
                    <div class="input-group">
                        <label>Jenis Kelamin *</label>
                        <select name="jenis_kelamin" required>
                            <option value="Jantan" <?= $row['jenis_kelamin']==='Jantan' ? 'selected' : ''; ?>>Jantan</option>
                            <option value="Betina" <?= $row['jenis_kelamin']==='Betina' ? 'selected' : ''; ?>>Betina</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label>Status</label>
                        <input type="text" name="status" value="<?= htmlspecialchars($row['status']); ?>">
                    </div>
                </div>
                <div class="input-group">
                    <label>Kondisi Kesehatan</label>
                    <textarea name="kondisi" rows="3"><?= htmlspecialchars($row['kondisi']); ?></textarea>
                </div>
                <div class="input-group">
                    <label>Cerita / Latar Belakang</label>
                    <textarea name="cerita" rows="5"><?= htmlspecialchars($row['cerita']); ?></textarea>
                </div>
                <div class="input-group">
                    <label>Foto Saat Ini</label>
                    <?php if(!empty($row['foto'])): ?>
                        <img src="../uploads/<?= htmlspecialchars($row['foto']); ?>" height="100" style="border-radius:10px; display:block; margin-bottom:10px;">
                    <?php endif; ?>
                    <label>Ganti Foto <small>(kosongkan jika tidak ingin mengganti)</small></label>
                    <input type="file" name="foto" accept="image/jpeg,image/png,image/webp">
                </div>
                <div class="form-actions">
                    <button type="submit" name="submit" class="btn-save">💾 Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
