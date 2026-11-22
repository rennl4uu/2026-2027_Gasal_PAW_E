<?php

require_once 'koneksi.php';
require_once 'auth.php';
wajib_owner();

$id = $_POST['id'];
$kode_barang = $_POST['kode_barang'];
$nama_barang = $_POST['nama_barang'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];
$supplier_id = $_POST['supplier_id'] !== '' ? $_POST['supplier_id'] : null;

$update = $DBH->prepare("
		UPDATE barang
			SET
				kode_barang = ?,
				nama_barang = ?,
				harga = ?,
				stok = ?,
				supplier_id = ?
		WHERE id = ?
	");

$update->execute([$kode_barang, $nama_barang, $harga, $stok, $supplier_id, $id]);
header('Location: barang.php?pesan=' . urlencode('Data berhasil diubah'));
?>
