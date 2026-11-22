<?php

require_once 'koneksi.php';
require_once 'auth.php';
wajib_owner();

$id = $_GET['id'];

// Cek dulu apakah pelanggan sudah dipakai di tabel transaksi
$cek = $DBH->prepare("SELECT COUNT(*) FROM transaksi WHERE pelanggan_id = ?");
$cek->execute([$id]);

if ($cek->fetchColumn() > 0) {
	header('Location: pelanggan.php?pesan=' . urlencode('Pelanggan tidak bisa dihapus karena masih digunakan pada transaksi'));
	exit;
}

$hapus = $DBH->prepare("DELETE FROM pelanggan WHERE id = ?");
$hapus->execute([$id]);
header('Location: pelanggan.php?pesan=' . urlencode('Data berhasil dihapus'));
?>
