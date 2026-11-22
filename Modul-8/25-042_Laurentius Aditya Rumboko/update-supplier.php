<?php

require_once 'koneksi.php';
require_once 'auth.php';
wajib_owner();

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
header('Location: supplier.php?pesan=' . urlencode('Data berhasil diubah'));
?>
