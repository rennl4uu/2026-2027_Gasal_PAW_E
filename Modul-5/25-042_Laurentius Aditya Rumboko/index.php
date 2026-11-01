<?php
include "koneksi.php";

// Tampilkan 3 data dulu, atau semua data jika ada ?semua=1
$semua = isset($_GET['semua']);
$sql = "SELECT * FROM supplier ORDER BY id" . ($semua ? "" : " LIMIT 3");
$hasil = mysqli_query($conn, $sql);
$no = 1;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Master Supplier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="box">
        <a class="btn hijau kanan" href="tambah.php">Tambah Data</a>
        <h2>Data Master Supplier</h2>

        <?php if (isset($_GET['pesan'])) { ?>
            <p class="pesan"><?= htmlspecialchars($_GET['pesan']) ?></p>
        <?php } ?>

        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Telp</th>
                <th>Alamat</th>
                <th>Tindakan</th>
            </tr>
            <?php while ($r = mysqli_fetch_assoc($hasil)) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($r['nama']) ?></td>
                    <td><?= htmlspecialchars($r['telp']) ?></td>
                    <td><?= htmlspecialchars($r['alamat']) ?></td>
                    <td>
                        <a class="btn oranye" href="edit.php?id=<?= $r['id'] ?>">Edit</a>
                        <form class="inline" method="post" action="hapus.php"
                              onsubmit="return confirm('Anda yakin akan menghapus supplier ini?')">
                            <input type="hidden" name="id" value="<?= $r['id'] ?>">
                            <button class="btn merah" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <p>
            <?php if (!$semua) { ?>
                <a href="index.php?semua=1">Lihat semua</a>
            <?php } ?>
        </p>
    </div>
</body>
</html>