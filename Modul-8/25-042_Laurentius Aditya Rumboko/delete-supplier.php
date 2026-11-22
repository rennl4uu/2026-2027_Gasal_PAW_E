<?php

require_once 'koneksi.php';
require_once 'auth.php';
wajib_owner();

$id = $_GET['id'];
$hapus = $DBH->prepare("DELETE FROM supplier WHERE id = ?");

$hapus->execute([$id]);
header('Location: supplier.php?pesan=' . urlencode('Data berhasil dihapus'));
?>
