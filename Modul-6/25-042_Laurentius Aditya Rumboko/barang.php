<?php

require_once 'koneksi.php';

$barang = $DBH->prepare("
		SELECT b.*, s.nama AS supplier
		FROM barang b
		LEFT JOIN supplier s ON s.id = b.supplier_id
		ORDER BY b.id
	");
$barang->execute();

$data = $barang->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Data Master Barang</title>
</head>
<body>
	<?php include 'menu.php'; ?>

	<h2>Data Master Barang</h2>

	<table border="1" cellspacing="0" cellpadding="5">
		<tr>
			<th>No</th>
			<th>Kode</th>
			<th>Nama Barang</th>
			<th>Harga</th>
			<th>Stok</th>
			<th>Supplier</th>
			<th>Tindakan</th>
		</tr>
		<?php $no = 1; ?>
		<?php foreach ($data as $row): ?>
			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo $row['kode_barang'] ?></td>
				<td><?php echo htmlspecialchars($row['nama_barang']) ?></td>
				<td><?php echo number_format($row['harga'], 0, ',', '.') ?></td>
				<td><?php echo $row['stok'] ?></td>
				<td><?php echo htmlspecialchars($row['supplier'] ?? '-') ?></td>
				<td>
					<a href="delete-barang.php?id=<?php echo $row['id'] ?>"
					   onclick="return confirm('Anda yakin akan menghapus barang ini?')">Hapus</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</body>
</html>