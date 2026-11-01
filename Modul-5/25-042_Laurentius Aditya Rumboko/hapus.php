<?php
include "koneksi.php";

// Proses hapus data supplier (hanya lewat POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) $_POST['id'];

    $stmt = mysqli_prepare($conn, "DELETE FROM supplier WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    header("Location: index.php?pesan=" . urlencode("Data berhasil dihapus"));
    exit;
}

// Jika dibuka langsung tanpa POST, kembali ke halaman utama
header("Location: index.php");
exit;