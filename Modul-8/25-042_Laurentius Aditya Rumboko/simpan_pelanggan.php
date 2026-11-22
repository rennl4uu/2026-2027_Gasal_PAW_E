<?php

require_once 'koneksi.php';
require_once 'auth.php';
wajib_owner();

// pastikan request berasal dari form (metode POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: pelanggan.php');
	exit;
}

$id = $_POST['id'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$telp = $_POST['telp'];
$alamat = $_POST['alamat'];

// ID pelanggan adalah primary key, tidak boleh kembar
$cek = $DBH->prepare("SELECT COUNT(*) FROM pelanggan WHERE id = ?");
$cek->execute([$id]);

if ($cek->fetchColumn() > 0) {
	header('Location: pelanggan.php?pesan=' . urlencode('ID pelanggan sudah dipakai'));
	exit;
}

$tambah = $DBH->prepare("
		INSERT INTO pelanggan
			(id, nama, jenis_kelamin, telp, alamat)
		VALUES
			(?, ?, ?, ?, ?)
	");

$tambah->execute([$id, $nama, $jenis_kelamin, $telp, $alamat]);
header('Location: pelanggan.php?pesan=' . urlencode('Data berhasil ditambahkan'));
?>