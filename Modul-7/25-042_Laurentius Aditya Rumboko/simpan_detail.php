<?php

require_once 'koneksi.php';

$transaksi_id = $_POST['transaksi_id'];
$barang_id = $_POST['barang_id'];
$qty = $_POST['qty'];

// Cek apakah barang sudah ada di transaksi ini (tidak boleh dobel)
$cek = $DBH->prepare("SELECT COUNT(*) FROM transaksi_detail WHERE transaksi_id = ? AND barang_id = ?");
$cek->execute([$transaksi_id, $barang_id]);

if ($cek->fetchColumn() > 0) {
	header('Location: detail-transaksi.php?id=' . $transaksi_id . '&pesan=' . urlencode('Barang sudah ada pada transaksi ini'));
	exit;
}

// Ambil harga barang dari tabel barang
$ambil = $DBH->prepare("SELECT harga FROM barang WHERE id = ?");
$ambil->execute([$barang_id]);
$harga = $ambil->fetchColumn();

// Simpan ke transaksi_detail
$tambah = $DBH->prepare("
		INSERT INTO transaksi_detail
			(transaksi_id, barang_id, harga, qty)
		VALUES
			(?, ?, ?, ?)
	");
$tambah->execute([$transaksi_id, $barang_id, $harga, $qty]);

// Hitung ulang total transaksi (jumlah harga x qty seluruh detail), simpan ke tabel transaksi
$update = $DBH->prepare("
		UPDATE transaksi
			SET total = (
				SELECT SUM(harga * qty)
				FROM transaksi_detail
				WHERE transaksi_id = ?
			)
		WHERE id = ?
	");
$update->execute([$transaksi_id, $transaksi_id]);

header('Location: detail-transaksi.php?id=' . $transaksi_id . '&pesan=' . urlencode('Barang berhasil ditambahkan'));
?>