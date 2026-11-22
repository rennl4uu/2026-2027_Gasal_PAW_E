<?php

require_once 'koneksi.php';
require_once 'auth.php';
wajib_owner();

// pastikan request berasal dari form (metode POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: barang.php');
	exit;
}

$kode_barang = $_POST['kode_barang'];
$nama_barang = $_POST['nama_barang'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];
$supplier_id = $_POST['supplier_id'] !== '' ? $_POST['supplier_id'] : null;

$tambah = $DBH->prepare("
		INSERT INTO barang
			(kode_barang, nama_barang, harga, stok, supplier_id)
		VALUES
			(?, ?, ?, ?, ?)
	");

$tambah->execute([$kode_barang, $nama_barang, $harga, $stok, $supplier_id]);
header('Location: barang.php?pesan=' . urlencode('Data berhasil ditambahkan'));
?>