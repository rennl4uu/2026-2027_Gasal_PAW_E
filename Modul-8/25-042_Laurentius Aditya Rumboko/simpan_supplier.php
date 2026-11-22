<?php

require_once 'koneksi.php';
require_once 'auth.php';
wajib_owner();

// pastikan request berasal dari form (metode POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: supplier.php');
	exit;
}

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
header('Location: supplier.php?pesan=' . urlencode('Data berhasil ditambahkan'));
?>