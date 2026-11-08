<?php

require_once 'koneksi.php';

// Tampilkan 3 data dulu, atau semua data jika ada ?semua=1
$semua = isset($_GET['semua']);
$sql = "SELECT * FROM supplier ORDER BY id";
if (!$semua) {
	$sql .= " LIMIT 3";
}

$supplier = $DBH->prepare($sql);
$supplier->execute();

$data = $supplier->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Data Master Supplier</title>
</head>
<body>
	<?php include 'menu.php'; ?>

	<h2>Data Master Supplier</h2>
	<a href="tambah-supplier.php">Tambah Data</a>
	<br><br>

	<table border="1" cellspacing="0" cellpadding="5">
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Telp</th>
			<th>Alamat</th>
			<th>Tindakan</th>
		</tr>
		<?php $no = 1; ?>
		<?php foreach ($data as $row): ?>
			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo htmlspecialchars($row['nama']) ?></td>
				<td><?php echo htmlspecialchars($row['telp']) ?></td>
				<td><?php echo htmlspecialchars($row['alamat']) ?></td>
				<td>
					<a href="edit-supplier.php?id=<?php echo $row['id'] ?>">Edit</a> |
					<a href="delete-supplier.php?id=<?php echo $row['id'] ?>"
					   onclick="return confirm('Anda yakin akan menghapus supplier ini?')">Hapus</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>

	<?php if (!$semua): ?>
		<p><a href="index.php?semua=1">Lihat semua</a></p>
	<?php endif; ?>
</body>
</html>