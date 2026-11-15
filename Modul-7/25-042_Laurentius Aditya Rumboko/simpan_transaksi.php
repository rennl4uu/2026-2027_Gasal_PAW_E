<?php

require_once 'koneksi.php';

$waktu_transaksi = $_POST['waktu_transaksi'];
$keterangan = $_POST['keterangan'];
$pelanggan_id = $_POST['pelanggan_id'];

// Total awal 0, nanti dihitung otomatis saat detail ditambahkan
$tambah = $DBH->prepare("
		INSERT INTO transaksi
			(waktu_transaksi, keterangan, total, pelanggan_id)
		VALUES
			(?, ?, 0, ?)
	");

$tambah->execute([$waktu_transaksi, $keterangan, $pelanggan_id]);

// Lanjut ke halaman detail untuk mengisi barang
$id = $DBH->lastInsertId();
header('Location: detail-transaksi.php?id=' . $id);
?>
