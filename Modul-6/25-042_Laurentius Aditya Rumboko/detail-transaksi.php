<?php

require_once 'koneksi.php';

$id = $_GET['id'];

// Data master (transaksi)
$transaksi = $DBH->prepare("
		SELECT t.*, p.nama AS pelanggan
		FROM transaksi t
		JOIN pelanggan p ON p.id = t.pelanggan_id
		WHERE t.id = ?
	");
$transaksi->execute([$id]);
$master = $transaksi->fetch();

// Jika data tidak ditemukan
if (!$master) {
	header('Location: transaksi.php');
	exit;
}

// Data detail (barang di dalam transaksi ini)
$detail = $DBH->prepare("
		SELECT d.*, b.nama_barang
		FROM transaksi_detail d
		JOIN barang b ON b.id = d.barang_id
		WHERE d.transaksi_id = ?
	");
$detail->execute([$id]);
$data_detail = $detail->fetchAll();

// Daftar id barang yang sudah dipakai (untuk di-disabled di dropdown)
$dipakai = [];
foreach ($data_detail as $row) {
	$dipakai[] = $row['barang_id'];
}

// Semua barang untuk dropdown
$barang = $DBH->prepare("SELECT id, nama_barang, harga FROM barang ORDER BY nama_barang");
$barang->execute();
$data_barang = $barang->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Detail Transaksi</title>
</head>
<body>
	<?php include 'menu.php'; ?>

	<h2>Detail Transaksi #<?php echo $id ?></h2>
	<p>
		Tanggal: <?php echo $master['waktu_transaksi'] ?><br>
		Pelanggan: <?php echo htmlspecialchars($master['pelanggan']) ?><br>
		Keterangan: <?php echo htmlspecialchars($master['keterangan']) ?>
	</p>

	<h3>Tambah Barang</h3>
	<form method="POST" action="simpan_detail.php">
		<input type="hidden" name="transaksi_id" value="<?php echo $id ?>">
		Barang
		<select name="barang_id" required>
			<option value="">-- Pilih barang --</option>
			<?php foreach ($data_barang as $row): ?>
				<option value="<?php echo $row['id'] ?>"
					<?php if (in_array($row['id'], $dipakai)) echo 'disabled' ?>>
					<?php echo htmlspecialchars($row['nama_barang']) ?>
					(<?php echo number_format($row['harga'], 0, ',', '.') ?>)
				</option>
			<?php endforeach; ?>
		</select>
		Qty <input type="number" name="qty" value="1" min="1" required>
		<button type="submit">Tambah</button>
	</form>
	<br>

	<table border="1" cellspacing="0" cellpadding="5">
		<tr>
			<th>No</th>
			<th>Barang</th>
			<th>Harga</th>
			<th>Qty</th>
			<th>Subtotal</th>
		</tr>
		<?php $no = 1; ?>
		<?php foreach ($data_detail as $row): ?>
			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo htmlspecialchars($row['nama_barang']) ?></td>
				<td><?php echo number_format($row['harga'], 0, ',', '.') ?></td>
				<td><?php echo $row['qty'] ?></td>
				<td><?php echo number_format($row['harga'] * $row['qty'], 0, ',', '.') ?></td>
			</tr>
		<?php endforeach; ?>
		<tr>
			<th colspan="4">Total</th>
			<th><?php echo number_format($master['total'], 0, ',', '.') ?></th>
		</tr>
	</table>

	<p><a href="transaksi.php">Kembali</a></p>
</body>
</html>