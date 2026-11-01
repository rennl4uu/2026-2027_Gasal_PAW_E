<?php
include "koneksi.php";

// Proses update data supplier
if (isset($_POST['update'])) {
    $stmt = mysqli_prepare($conn, "UPDATE supplier SET nama=?, telp=?, alamat=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "sssi", $_POST['nama'], $_POST['telp'], $_POST['alamat'], $_POST['id']);
    mysqli_stmt_execute($stmt);

    header("Location: index.php?pesan=" . urlencode("Data berhasil diubah"));
    exit;
}

// Mengambil ID supplier
$id = (int) ($_GET['id'] ?? 0);

// Mengambil data supplier berdasarkan ID
$stmt = mysqli_prepare($conn, "SELECT * FROM supplier WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$r = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

// Jika data tidak ditemukan
if (!$r) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Data Supplier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="box">
        <h2>Edit Data Master Supplier</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?= $r['id'] ?>">
            <p>
                <label>Nama</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($r['nama']) ?>" required>
            </p>
            <p>
                <label>Telp</label>
                <input type="text" name="telp" value="<?= htmlspecialchars($r['telp']) ?>" maxlength="12" required>
            </p>
            <p>
                <label>Alamat</label>
                <input type="text" name="alamat" value="<?= htmlspecialchars($r['alamat']) ?>" required>
            </p>
            <p class="aksi">
                <button class="btn hijau" type="submit" name="update">Update</button>
                <a class="btn merah" href="index.php">Batal</a>
            </p>
        </form>
    </div>
</body>
</html>