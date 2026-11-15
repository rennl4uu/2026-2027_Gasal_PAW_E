<p>
	<a href="index.php">Supplier</a> |
	<a href="barang.php">Barang</a> |
	<a href="transaksi.php">Transaksi</a> |
	<a href="laporan-penjualan.php">Laporan</a>
</p>
<hr>
<?php
// Menampilkan pesan jika ada (dikirim lewat URL)
if (isset($_GET['pesan'])) {
	echo '<p><b>' . htmlspecialchars($_GET['pesan']) . '</b></p>';
}
?>