<?php
// Pastikan session sudah aktif sebelum mengakses $_SESSION
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

$__level = $_SESSION['level'] ?? null;
$__nama  = $_SESSION['nama']  ?? null;
?>
<div class="navbar">
	<div class="nav-left">
		<a href="index.php">Home</a>
		<?php if ($__level == 1): ?>
			<div class="dropdown">
				<a href="#">Data Master &#9662;</a>
				<div class="dropdown-isi">
					<a href="barang.php">Data Barang</a>
					<a href="supplier.php">Data Supplier</a>
					<a href="pelanggan.php">Data Pelanggan</a>
					<a href="user.php">Data User</a>
				</div>
			</div>
		<?php endif; ?>
		<a href="transaksi.php">Transaksi</a>
		<a href="laporan-penjualan.php">Laporan</a>
	</div>
	<div class="nav-right">
		<?php if ($__nama !== null): ?>
			<span><?php echo htmlspecialchars($__nama) ?></span>
			<a href="logout.php">Logout</a>
		<?php else: ?>
			<a href="login.php">Login</a>
		<?php endif; ?>
	</div>
</div>
<?php
// Menampilkan pesan jika ada (dikirim lewat URL)
if (isset($_GET['pesan'])) {
	echo '<div class="pesan">' . htmlspecialchars($_GET['pesan']) . '</div>';
}
?>