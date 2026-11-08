<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tambah Data Supplier</title>
</head>
<body>
	<?php include 'menu.php'; ?>

	<h2>Tambah Data Master Supplier Baru</h2>

	<form method="POST" action="simpan_supplier.php">
		<p>
			Nama <br>
			<input type="text" name="nama" placeholder="Nama" required>
		</p>
		<p>
			Telp <br>
			<input type="text" name="telp" placeholder="telp" maxlength="12" required>
		</p>
		<p>
			Alamat <br>
			<input type="text" name="alamat" placeholder="alamat" required>
		</p>
		<button type="submit">Simpan</button>
		<a href="index.php">Batal</a>
	</form>
</body>
</html>
