<?php

require_once 'koneksi.php';
require_once 'auth.php';
wajib_owner();

$id = $_POST['id'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$telp = $_POST['telp'];
$alamat = $_POST['alamat'];

$update = $DBH->prepare("
		UPDATE pelanggan
			SET
				nama = ?,
				jenis_kelamin = ?,
				telp = ?,
				alamat = ?
		WHERE id = ?
	");

$update->execute([$nama, $jenis_kelamin, $telp, $alamat, $id]);
header('Location: pelanggan.php?pesan=' . urlencode('Data berhasil diubah'));
?>
