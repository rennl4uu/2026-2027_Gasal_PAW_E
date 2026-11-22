<?php

require_once 'koneksi.php';
require_once 'auth.php';
wajib_owner();

$pelanggan = $DBH->prepare("SELECT * FROM pelanggan ORDER BY id");
$pelanggan->execute();

$data = $pelanggan->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Data Master Pelanggan</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<h2>Data Master Pelanggan</h2>
	<a href="tambah-pelanggan.php">Tambah Data</a>
	<br><br>

	<table border="1" cellspacing="0" cellpadding="5">
		<tr>
			<th>No</th>
			<th>ID</th>
			<th>Nama</th>
			<th>Jenis Kelamin</th>
			<th>Telp</th>
			<th>Alamat</th>
			<th>Tindakan</th>
		</tr>
		<?php $no = 1; ?>
		<?php foreach ($data as $row): ?>
			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo htmlspecialchars($row['id']) ?></td>
				<td><?php echo htmlspecialchars($row['nama']) ?></td>
				<td><?php echo $row['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
				<td><?php echo htmlspecialchars($row['telp']) ?></td>
				<td><?php echo htmlspecialchars($row['alamat']) ?></td>
				<td>
					<a href="edit-pelanggan.php?id=<?php echo urlencode($row['id']) ?>">Edit</a> |
					<a href="delete-pelanggan.php?id=<?php echo urlencode($row['id']) ?>"
					   onclick="return confirm('Anda yakin akan menghapus pelanggan ini?')">Hapus</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</body>
</html>
