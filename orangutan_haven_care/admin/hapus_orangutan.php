<?php
session_start();
include '../config/koneksi.php';
 
// WAJIB login — dulu tidak ada ini!
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
 
$id = (int)($_GET['id'] ?? 0);
if($id <= 0){ header("Location: data_orangutan.php"); exit; }
 
// Ambil foto dulu sebelum hapus
$stmt = mysqli_prepare($conn, "SELECT foto FROM orangutan WHERE id_orangutan = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);
 
if($row){
    // Hapus file foto dari server
    if(!empty($row['foto']) && file_exists("../uploads/".$row['foto'])){
        unlink("../uploads/".$row['foto']);
    }
    // Hapus dari database
    $stmt = mysqli_prepare($conn, "DELETE FROM orangutan WHERE id_orangutan = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
 
header("Location: data_orangutan.php?msg=hapus");
exit;