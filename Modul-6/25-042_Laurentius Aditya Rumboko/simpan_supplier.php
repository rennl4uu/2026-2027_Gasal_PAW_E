<?php

require_once 'koneksi.php';

$nama = $_POST['nama'];
$telp = $_POST['telp'];
$alamat = $_POST['alamat'];

$tambah = $DBH->prepare("
		INSERT INTO supplier
			(nama, telp, alamat)
		VALUES
			(?, ?, ?)
	");

$tambah->execute([$nama, $telp, $alamat]);
header('Location: index.php?pesan=' . urlencode('Data berhasil ditambahkan'));
?>
