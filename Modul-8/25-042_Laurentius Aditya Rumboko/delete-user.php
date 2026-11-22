<?php

require_once 'koneksi.php';
require_once 'auth.php';
wajib_owner();

$id = $_GET['id'];

// User tidak boleh menghapus akunnya sendiri yang sedang login
if ($id == $_SESSION['id_user']) {
	header('Location: user.php?pesan=' . urlencode('Akun yang sedang login tidak bisa dihapus'));
	exit;
}

$hapus = $DBH->prepare("DELETE FROM user WHERE id_user = ?");
$hapus->execute([$id]);
header('Location: user.php?pesan=' . urlencode('Data berhasil dihapus'));
?>
