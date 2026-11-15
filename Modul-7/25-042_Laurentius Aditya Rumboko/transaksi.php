<?php

require_once 'koneksi.php';

$transaksi = $DBH->prepare("
		SELECT t.*, p.nama AS pelanggan
		FROM transaksi t
		JOIN pelanggan p ON p.id = t.pelanggan_id
		ORDER BY t.id DESC
	");
$transaksi->execute();

$data = $transaksi->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Data Transaksi</title>
</head>
<body>
	<?php include 'menu.php'; ?>

	<h2>Data Transaksi</h2>
	<a href="tambah-transaksi.php">Tambah Transaksi</a>
	<br><br>

	<table border="1" cellspacing="0" cellpadding="5">
		<tr>
			<th>ID</th>
			<th>Tanggal</th>
			<th>Pelanggan</th>
			<th>Keterangan</th>
			<th>Total</th>
			<th>Tindakan</th>
		</tr>
		<?php foreach ($data as $row): ?>
			<tr>
				<td><?php echo $row['id'] ?></td>
				<td><?php echo $row['waktu_transaksi'] ?></td>
				<td><?php echo htmlspecialchars($row['pelanggan']) ?></td>
				<td><?php echo htmlspecialchars($row['keterangan']) ?></td>
				<td><?php echo number_format($row['total'], 0, ',', '.') ?></td>
				<td><a href="detail-transaksi.php?id=<?php echo $row['id'] ?>">Detail</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
</body>
</html>
