<?php

require_once 'koneksi.php';

$id = $_GET['id'];

// Cek dulu apakah barang sudah dipakai di tabel transaksi_detail
$cek = $DBH->prepare("SELECT COUNT(*) FROM transaksi_detail WHERE barang_id = ?");
$cek->execute([$id]);
$jumlah = $cek->fetchColumn();

// Jika sudah dipakai, barang tidak boleh dihapus
if ($jumlah > 0) {
	header('Location: barang.php?pesan=' . urlencode('Barang tidak bisa dihapus karena masih digunakan pada transaksi'));
	exit;
}

// Jika belum dipakai, hapus seperti biasa
$hapus = $DBH->prepare("DELETE FROM barang WHERE id = ?");
$hapus->execute([$id]);
header('Location: barang.php?pesan=' . urlencode('Data barang berhasil dihapus'));
?>