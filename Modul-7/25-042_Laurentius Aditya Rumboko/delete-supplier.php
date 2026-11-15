<?php

require_once 'koneksi.php';

$id = $_GET['id'];
$hapus = $DBH->prepare("DELETE FROM supplier WHERE id = ?");

$hapus->execute([$id]);
header('Location: index.php?pesan=' . urlencode('Data berhasil dihapus'));
?>
