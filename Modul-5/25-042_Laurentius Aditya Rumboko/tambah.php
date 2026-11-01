<?php
include "koneksi.php";

// Proses simpan data supplier baru
if (isset($_POST['simpan'])) {
    $stmt = mysqli_prepare($conn, "INSERT INTO supplier (nama, telp, alamat) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $_POST['nama'], $_POST['telp'], $_POST['alamat']);
    mysqli_stmt_execute($stmt);

    header("Location: index.php?pesan=" . urlencode("Data berhasil ditambahkan"));
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Supplier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="box">
        <h2>Tambah Data Master Supplier Baru</h2>
        <form method="post">
            <p>
                <label>Nama</label>
                <input type="text" name="nama" placeholder="Nama" required>
            </p>
            <p>
                <label>Telp</label>
                <input type="text" name="telp" placeholder="telp" maxlength="12" required>
            </p>
            <p>
                <label>Alamat</label>
                <input type="text" name="alamat" placeholder="alamat" required>
            </p>
            <p class="aksi">
                <button class="btn hijau" type="submit" name="simpan">Simpan</button>
                <a class="btn merah" href="index.php">Batal</a>
            </p>
        </form>
    </div>
</body>
</html>