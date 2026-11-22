<?php

require_once 'koneksi.php';
require_once 'auth.php';
wajib_owner();

// Proteksi: pastikan request berasal dari form (metode POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: user.php');
	exit;
}

$username = trim($_POST['username']);
$password = $_POST['password'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$hp = $_POST['hp'];
$level = $_POST['level'];

// Username tidak boleh kembar
$cek = $DBH->prepare("SELECT COUNT(*) FROM user WHERE username = ?");
$cek->execute([$username]);

if ($cek->fetchColumn() > 0) {
	header('Location: user.php?pesan=' . urlencode('Username sudah dipakai'));
	exit;
}

// Password disimpan dalam bentuk MD5
$tambah = $DBH->prepare("
		INSERT INTO user
			(username, password, nama, alamat, hp, level)
		VALUES
			(?, ?, ?, ?, ?, ?)
	");

$tambah->execute([$username, md5($password), $nama, $alamat, $hp, $level]);
header('Location: user.php?pesan=' . urlencode('Data berhasil ditambahkan'));
?>