<?php

require_once 'koneksi.php';
require_once 'auth.php';
wajib_owner();

$user = $DBH->prepare("SELECT * FROM user ORDER BY id_user");
$user->execute();

$data = $user->fetchAll();

$nama_level = [1 => 'Owner', 2 => 'Kasir', 3 => 'Gudang'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Data Master User</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<h2>Data Master User</h2>
	<a href="tambah-user.php">Tambah Data</a>
	<br><br>

	<table border="1" cellspacing="0" cellpadding="5">
		<tr>
			<th>No</th>
			<th>Username</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>HP</th>
			<th>Level</th>
			<th>Tindakan</th>
		</tr>
		<?php $no = 1; ?>
		<?php foreach ($data as $row): ?>
			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo htmlspecialchars($row['username']) ?></td>
				<td><?php echo htmlspecialchars($row['nama']) ?></td>
				<td><?php echo htmlspecialchars($row['alamat']) ?></td>
				<td><?php echo htmlspecialchars($row['hp']) ?></td>
				<td><?php echo $nama_level[$row['level']] ?? $row['level'] ?></td>
				<td>
					<a href="edit-user.php?id=<?php echo $row['id_user'] ?>">Edit</a> |
					<a href="delete-user.php?id=<?php echo $row['id_user'] ?>"
					   onclick="return confirm('Anda yakin akan menghapus user ini?')">Hapus</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</body>
</html>
