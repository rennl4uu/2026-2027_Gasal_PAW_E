<?php

require_once 'koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$telp = $_POST['telp'];
$alamat = $_POST['alamat'];

$update = $DBH->prepare("
		UPDATE supplier
			SET
				nama = ?,
				telp = ?,
				alamat = ?
		WHERE id = ?
	");

$update->execute([$nama, $telp, $alamat, $id]);
header('Location: index.php?pesan=' . urlencode('Data berhasil diubah'));
?>
